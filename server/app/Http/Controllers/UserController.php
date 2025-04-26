<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    // log
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            Log::info('Request Masuk:', [
                'method' => $request->method(),
                'url' => $request->fullUrl(),
                'body' => $request->isMethod('get') ? $request->query() : $request->all(),
                'params' => $request->route()->parameters(),
            ]);
            return $next($request);
        });
    }

     /**
     * @OA\Get(
     *     path="/allUser",
     *     tags={"User"},
     *     summary="Ambil semua user",
     *     description="Mengambil semua data user",
     *     @OA\Response(
     *         response=200,
     *         description="List semua user"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server Error"
     *     )
     * )
     */
    public function allUser()
    {
        try {
            $users = User::all();
            return response()->json($users, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/user/{id}",
     *     summary="Ambil user berdasarkan ID",
     *     tags={"User"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Data user"),
     *     @OA\Response(response=404, description="User tidak ditemukan")
     * )
     */
    public function userById($id)
    {
        try {
            $user = User::findOrFail($id);
            return response()->json($user, 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'User tidak ditemukan'], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/user/addUser",
     *     summary="Tambah user baru",
     *     tags={"User"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "email", "age"},
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="email", type="string"),
     *             @OA\Property(property="age", type="integer")
     *         )
     *     ),
     *     @OA\Response(response=201, description="User berhasil ditambah"),
     *     @OA\Response(response=422, description="Validasi gagal")
     * )
     */
    public function addUser(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'age' => 'required|integer|min:0',
            ]);
    
            $user = User::create($validated);
    
            return response()->json([
                'message' => 'User berhasil ditambah',
                'user' => $user,
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validasi gagal',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/user/editUser/{id}",
     *     summary="Edit data user",
     *     tags={"User"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="email", type="string"),
     *             @OA\Property(property="age", type="integer")
     *         )
     *     ),
     *     @OA\Response(response=200, description="User berhasil diupdate"),
     *     @OA\Response(response=422, description="Validasi gagal")
     * )
     */
    public function editUser(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
    
            $validator = Validator::make($request->all(), [
                'name' => 'nullable|string|max:255',
                'email' => 'nullable|email|unique:users,email,' . $id,
                'age' => 'nullable|integer|min:0',
            ]);
    
            $validated = $validator->validated();
            $user->update(array_filter($validated));
    
            return response()->json([
                'message' => 'User berhasil diupdate',
                'user' => $user,
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validasi gagal',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'User tidak ditemukan'], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

     /**
     * @OA\Delete(
     *     path="/api/user/delUser/{id}",
     *     summary="Hapus user berdasarkan ID",
     *     tags={"User"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="User berhasil dihapus"),
     *     @OA\Response(response=404, description="User tidak ditemukan")
     * )
     */
    public function delUser($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return response()->json(['message' => 'User berhasil dihapus'], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'User tidak ditemukan'], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
