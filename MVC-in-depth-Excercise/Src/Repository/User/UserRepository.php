<?php


namespace Src\Repository\User;

use Core\Database\DatabaseInterface;
use Src\Models\Entity\User;
use Src\Models\BindingModels\UserRegisterBindingModel;

class UserRepository implements UserRepositoryInterface
{

    /**
     * @var DatabaseInterface
     */
    private $db;

    /**
     * UserRepository constructor.
     * @param DatabaseInterface $db
     */
    public function __construct(DatabaseInterface $db)
    {
        $this->db = $db;
    }

    public function insert(UserRegisterBindingModel $user): bool
    {
        $this->db->query("
        INSERT INTO 
        `users`
        (`username`, 
        `password`)
        VALUES (?, ?)
        ")->execute([
            $user->getUsername(),
            $user->getPassword()
        ]);

        return true;
    }

    public function findOneByUsername(string $username): ?User
    {
        return $this->db->query("
        SELECT
        `id`,
        `username`, 
        `password`
        FROM `users`
        WHERE `username` = ?
        ")
            ->execute([$username])->fetch(User::class)
            ->current();
    }

}