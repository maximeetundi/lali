<?php

/**
 * @label Check SQL version
 * @description Check SQL version.
 */

DB::select('select version()')[0]->{'version()'};
