<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Configuration;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function register(Request $request) {
        Log::info($request);

        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'role' => '1',
            'branch_id' => '1',
            'department_id' => 1,
            'digital_signature' => '/media/sample.png',
            'digital_signature_url' => '/media/sample.png',
            'allow_confidential_results' => '0',
            'enabled' => 1,
            'license' => '0010',
        ]);

        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json(['token' => $token], 201);
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'status' => '401',
                'message' => 'Wrong Username or Password!',
            ]);
        }

        $user = User::where('email', $request->email)->firstOrFail();
        $role = $user->role;
        $user_id = $user->id;

        $tokenResult = $user->createToken('authToken');
        $token = $tokenResult->plainTextToken;

        $tokenId = explode('|', $token)[0];
        $tokenPlain = explode('|', $token)[1];
        $expiresAt = null;

        $configuration = Configuration::where('name', 'autoLogout')->first();
        if ($configuration && $configuration->status == 1) {
            $duration = is_numeric($configuration->value) ? (int) $configuration->value : 2;
            $expiresAt = Carbon::now('UTC')->setTimezone('Asia/Manila')->addMinutes($duration);
            
            DB::table('personal_access_tokens')
                ->where('id', $tokenId)
                ->update(['expires_at' => $expiresAt]);
        }
        
        Log::info('================ token =====================');
        Log::info($tokenPlain);

        return response()->json([
            'role' => $role,
            'user_id' => $user_id,
            'token' => $token,
            'expires_at' => $expiresAt ? $expiresAt->toDateTimeString() : null,
        ], 200);
    }

    public function user(Request $request) {
        return $request->user();
    }

    public function getUserRole(Request $request) {
        return response()->json(['role' => $request->user()->role]);
    }

    public function logout(Request $request) {
       $request->user()->tokens()->delete();

       return response()->json(['message' => 'Logged out successfully']);
    }

    public function get_user_phase_accesses(Request $request)
    {
        $userId = $request->query('loggedin_user_id');
        Log::info('get_user_phase_accesses');
        Log::info($userId);
        $phases = User::find($userId)->phases()->orderBy('sequence')->get(['phases.id', 'phases.name', 'phases.sequence']);
        Log::info($phases);
        return $phases;
    }
    
}
