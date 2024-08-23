<?php 

declare(strict_types = 1);

namespace Src\Controller;

use Src\Repository\UserRepository;

class UsersController {
    public function __construct(
        private UserRepository $userRepository
    ) {
    }

    public function indexUsers(): void 
    {
        $users = $this->userRepository->getAll();
        echo json_encode($users);
    }

    public function showUsers(int $id): void 
    {
        $user = $this->userRepository->getById($id);
        echo json_encode($user->jsonSerialize());
    }

    public function storeUsers(): void 
    {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);
        $this->userRepository->register($data['email'], $data['password']);
        echo json_encode(['message' => 'Usuario creado exitosamente']);
    }

    public function updateUsers(int $id): void 
    {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);
        $this->userRepository->update($id, $data['email'], $data['password']);
        echo json_encode(['message' => 'Usuario actualizado exitosamente']);
    }
    
    public function deleteUsers(int $id): void 
    {
        $this->userRepository->delete($id);
        echo json_encode(['message' => 'Usuario eliminado exitosamente']);
    }
}