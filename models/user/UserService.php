<?php

declare(strict_types=1);

namespace app\models\user;

use app\security\Security;
use yii\mail\MailerInterface;

class UserService
{
    private UserRepository $userRepository;
    private Security $security;
    private MailerInterface $mailer;

    public function __construct(
        UserRepository  $userRepository,
        Security        $security,
        MailerInterface $mailer
    )
    {
        $this->userRepository = $userRepository;
        $this->security = $security;
        $this->mailer = $mailer;
    }

    public function create(CreateForm $form): User
    {
        $password = $this->security->generateRandomString(8);
        $user = User::create(
            $form->username,
            $form->email,
            $this->security->generateRandomString(),
            $this->security->generateEmailVerificationToken(),
            $this->security->generatePasswordHash($password),
        );
        $this->userRepository->save($user);
        if ($form->sendEmail and !$this->mailer->compose('user/create', ['user' => $user, 'password' => $password])
                ->setSubject('An account has been created for you.')
                ->setTo($user->email)
                ->send()
        ) {
            throw new \RuntimeException('Error sending mail.');
        }
        return $user;
    }

    public function edit(int $id, EditForm $form): ?User
    {
        $user = $this->userRepository->getById($id);
        $user->edit(
            $form->username,
            $form->email,
            $form->status,
        );
        $this->userRepository->save($user);
        return $user;
    }

    public function remove($id)
    {
        $user = $this->userRepository->getById($id);
        $this->userRepository->remove($user);
    }
}