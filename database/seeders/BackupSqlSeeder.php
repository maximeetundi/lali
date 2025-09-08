<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class BackupSqlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = base_path('backup.sql');

        if (! File::exists($path)) {
            $this->command?->warn("backup.sql introuvable à la racine du projet: {$path}");
            return;
        }

        $sql = File::get($path);
        if (! is_string($sql) || trim($sql) === '') {
            $this->command?->warn('Le fichier backup.sql est vide.');
            return;
        }

        // Désactiver temporairement les contraintes pour éviter les erreurs d'ordre d'insertion
        DB::statement('PRAGMA foreign_keys = OFF;');

        try {
            // Séparer en statements individuels et ignorer le DDL (CREATE/ALTER/DROP...),
            // afin d'utiliser les schémas Laravel (migrations) et n'insérer que les données.
            $statements = array_filter(array_map('trim', preg_split('/;\s*(?:\r?\n|$)/m', $sql)));

            DB::beginTransaction();
            $executed = 0;
            foreach ($statements as $statement) {
                if ($statement === '') {
                    continue;
                }
                $upper = strtoupper(ltrim($statement));
                // Filtrer les DDL et autres statements à éviter
                if (
                    str_starts_with($upper, 'CREATE ') ||
                    str_starts_with($upper, 'ALTER ') ||
                    str_starts_with($upper, 'DROP ') ||
                    str_starts_with($upper, 'PRAGMA ') ||
                    str_starts_with($upper, 'BEGIN ') ||
                    str_starts_with($upper, 'COMMIT') ||
                    str_starts_with($upper, 'END') ||
                    str_starts_with($upper, 'VACUUM')
                ) {
                    continue;
                }

                // Ignorer les insertions dans la table migrations pour éviter les conflits
                if (preg_match('/^INSERT\s+INTO\s+"?migrations"?/i', $statement)) {
                    continue;
                }

                // Exécuter le DML (INSERT/UPDATE/DELETE/REPLACE, etc.)
                DB::unprepared($statement . ';');
                $executed++;
            }
            DB::commit();
            $this->command?->info("Import SQL (backup.sql) terminé: {$executed} statements exécutés.");
        } catch (\Throwable $e) {
            DB::rollBack();
            $this->command?->error('Erreur pendant l\'import SQL: ' . $e->getMessage());
            throw $e;
        } finally {
            DB::statement('PRAGMA foreign_keys = ON;');
        }
    }
}
