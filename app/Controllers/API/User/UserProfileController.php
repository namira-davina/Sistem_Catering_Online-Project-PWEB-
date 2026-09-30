<?php

namespace App\Controllers\API\User;

use App\Controllers\API\RestfulController;
use App\Models\UserModel;

class UserProfileController extends RestfulController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    // =========================
    // GET PROFILE
    // =========================
    public function index($id = null)
    {
        $user = $this->userModel->find($id);

        if (!$user) {

            return $this->responseHasil(
                404,
                false,
                'User tidak ditemukan'
            );
        }

        unset($user['password_hash']);

        // photo url
        $photo = !empty($user['photo'])
            ? base_url('profile/' . $user['photo'])
            : base_url('images/profile.png');

        $data = [
            'id'       => $user['id'],
            'username' => $user['username'],
            'email'    => $user['email'],
            'alamat'   => $user['alamat'] ?? null,
            'nomor_hp' => $user['nomor_hp'] ?? null,
            'photo'    => $photo
        ];

        return $this->responseHasil(
            200,
            true,
            $data
        );
    }

    // =========================
    // UPDATE PROFILE
    // =========================
    public function update($id = null)
    {
        $user = $this->userModel->find($id);

        if (!$user) {

            return $this->responseHasil(
                404,
                false,
                'User tidak ditemukan'
            );
        }

        $contentType = $this->request->getHeaderLine('Content-Type');
        $payload = stripos($contentType, 'application/json') !== false
            ? ($this->request->getJSON(true) ?: [])
            : [];
        $data = [];

        foreach (['username', 'alamat', 'nomor_hp'] as $field) {
            $value = $this->request->getPost($field) ?? ($payload[$field] ?? null);

            if ($value !== null) {
                $data[$field] = $value;
            }
        }

        // upload photo
        $file = $this->request->getFile('photo');

        if ($file && $file->getError() !== UPLOAD_ERR_NO_FILE) {
            $validationRule = [
                'photo' => [
                    'rules' => 'uploaded[photo]|is_image[photo]|mime_in[photo,image/jpg,image/jpeg,image/png,image/webp]|max_size[photo,2048]',
                    'errors' => [
                        'is_image' => 'File photo harus berupa gambar',
                        'mime_in'  => 'Format photo harus jpg, jpeg, png, atau webp',
                        'max_size' => 'Ukuran photo maksimal 2MB',
                    ],
                ],
            ];

            if (!$this->validate($validationRule)) {
                return $this->responseHasil(
                    400,
                    false,
                    $this->validator->getErrors()
                );
            }

            if (!$file->isValid() || $file->hasMoved()) {
                return $this->responseHasil(
                    400,
                    false,
                    'Photo gagal diupload'
                );
            }

            $newName = $file->getRandomName();
            $uploadPath = FCPATH . 'profile';

            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0775, true);
            }

            $file->move($uploadPath, $newName);

            $data['photo'] = $newName;
        }

        if ($data === []) {
            return $this->responseHasil(
                400,
                false,
                'Tidak ada data yang diupdate'
            );
        }

        $this->userModel->update($id, $data);

        $updatedUser = $this->userModel->find($id);

        return $this->responseHasil(
            200,
            true,
            [
                'message' => 'Profile berhasil diupdate',
                'user'    => [
                    'id'       => $updatedUser['id'],
                    'username' => $updatedUser['username'],
                    'email'    => $updatedUser['email'],
                    'alamat'   => $updatedUser['alamat'] ?? null,
                    'nomor_hp' => $updatedUser['nomor_hp'] ?? null,
                    'photo'    => !empty($updatedUser['photo'])
                        ? base_url('profile/' . $updatedUser['photo'])
                        : base_url('images/profile.png'),
                ],
            ]
        );
    }
}
