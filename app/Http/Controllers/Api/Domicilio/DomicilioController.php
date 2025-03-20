<?php

namespace App\Http\Controllers\Api\Domicilio;

use App\Customs\Services\Domicilio\DomicilioService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Domicilio\DomicilioRequest;
use App\Models\Domicilio;
use App\Models\User;

class DomicilioController extends Controller
{
    public function __construct(private DomicilioService $Domicilio) {}
    public function store(DomicilioRequest $request)
    {
        $validatedData = $request->validated();
        try {
            $domicilio = $this->domicilio->create($validatedData);
            return response()->json(
                [
                    'status' => 'success',
                    'message' => 'Domicilio created successfully',
                    'data' => $domicilio
                ],
                201
            );
        } catch (\Throwable $th) {
            return $this->exceptionalError(msg: 'Domicilio creation failed, please try again later');
        }
    }
    public function update(DomicilioRequest $request, Domicilio $domicilio)
    {
        try {
            $validatedData = $request->validated();
            $domicilio = $this->domicilio->updateDomicilio($domicilio, $validatedData);
            return response()->json([
                'status' => 'success',
                'message' => 'Domicilio updated successfully',
                'data' => $domicilio
            ], 200);
        } catch (\Throwable $th) {
            return $this->exceptionalError(msg: 'Domicilio update failed, please try again later');
        }
    }
    public function exceptionalError($msg)
    {
        return response()->json([
            'status' => 'failed',
            'message' => $msg
        ], 500);
    }
    public function getUserDomicilios(User $user)
    {
        try {
            $domicilios = $this->domicilio->userDomicilios($user);
            if ($domicilios->count() < 1) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'No Domicilio was found for this user'
                ]);
            }
            return response()->json([
                'status' => 'success',
                'message' => 'Domicilios fetched successfully',
                'data' => $domicilios
            ]);
        } catch (\Throwable $th) {
            return $this->exceptionalError(msg: 'An error occurred while fetching domicilios, please try again later');
        }
    }
    public function show(Domicilio $domicilio)
    {
        $domicilio = $this->domicilio->postAuthorizationCheck($domicilio);
        return response()->json([
            'status' => 'success',
            'message' => 'Domicilio fetched successfuly',
            'data' => $domicilio
        ]);
    }
    public function delete(Domicilio $domicilio)
    {
        try {
            $deleteDomicilio = $this->domicilio->deleteDomicilio($domicilio);
            if (!$deleteDomicilio) {
                return $this->exceptionalError(msg: 'An error ocurred while trying to delete the post, please try again later');
            }
            return response()->json([
                'status' => 'success',
                'message' => 'Domicilio deleted successfully'
            ], 500);
        } catch (\Throwable $th) {
            return $this->exceptionalError(msg: 'Domicilio delete failed, please try again later');
        }
    }
}
