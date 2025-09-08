<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Shop\Customer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Domain\Shop\Customer\Models\Customer;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Put;
use Illuminate\Auth\AuthenticationException;
use App\Http\Resources\Shop\CustomerResource;
use Spatie\RouteAttributes\Attributes\Prefix;
use Spatie\RouteAttributes\Attributes\Middleware;

/**
 * @tags Customer
 */
#[Prefix('customers'), Middleware('auth:sanctum')]
class LogoutController
{
    /** @operationId profile */
    #[Put('logout', name: 'customers.logout')]
    public function __invoke(): mixed
    {

        $customer = Customer::where('reference_number', Auth::user()->reference_number)->first();

        if (null === $customer) {
            throw new AuthenticationException(trans('Invalid credentials.'));
        }

        $customer->tokens()->delete();

        return response()->json(['message' => 'logout']);   
    }
}
