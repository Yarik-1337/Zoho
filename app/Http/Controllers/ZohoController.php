<?php

namespace App\Http\Controllers;

use App\Http\Requests\DealRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ZohoController extends Controller
{
    protected string $clientId;
    protected string $clientSecret;
    protected string $refreshToken;
    protected string $apiDomain;

    public function __construct()
    {
        $this->clientId = env('ZOHO_CLIENT_ID');
        $this->clientSecret = env('ZOHO_CLIENT_SECRET');
        $this->refreshToken = env('ZOHO_REFRESH_TOKEN');
        $this->apiDomain = env('ZOHO_API_DOMAIN');
    }

    public function refreshToken(): JsonResponse
    {
        $response = Http::asForm()
            ->post("https://accounts.zoho.eu/oauth/v2/token", [
                'grant_type' => 'refresh_token',
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret,
                'refresh_token' => $this->refreshToken,
            ]);

        if ($response->ok()) {

            $data = $response->json();

            return response()->json($data);
        }

        return response()->json('Failed to refresh access token');
    }

    public function createRecord(DealRequest $request): JsonResponse
    {
        $data = $request->validated();

        $token = $request->bearerToken();

        if ($this->createAccount($data, $token)) {

            $this->createDeal($data, $token);

            return response()->json([
                'success' => true,
                'message' => 'Records created successfully!'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Record creation error'
        ], 500);
    }

    public function createAccount($data, $token): mixed
    {
        $accountResponse = Http::withToken($token)
            ->post($this->apiDomain . '/crm/v2/Accounts', [
                'data' => [
                    [
                        'Account_Name' => $data['account_name'],
                        'Phone' => $data['phone'],
                    ]
                ]
            ]);

        if ($accountResponse->successful()) {
            return $accountResponse['data'];
        }

        return false;
    }

    public function createDeal($data, $token): void
    {
        Http::withToken($token)
            ->post($this->apiDomain . '/crm/v2/Deals', [
                'data' => [
                    [
                        'Deal_Name' => $data['deal_name'],
                        'Stage' => $data['stage'],
                        'Account_Name' => $data['account_name'],
                    ]
                ]
            ]);
    }
}
