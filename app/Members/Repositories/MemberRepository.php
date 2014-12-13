<?php namespace TGLD\Members\Repositories;

use TGLD\Core\EloquentRepository;
use TGLD\Members\Member;

class MemberRepository extends EloquentRepository
{
    function __construct(Member $model)
    {
        $this->model = $model;
    }

    /**
     * @param $token
     */
    public function activate($token)
    {
        $user = $this->model->where('username', '=', $token->activate_token)->first();

        $user->is_active = 1;

        $this->save($user);
    }

    /**
     * @param $username
     * @return mixed
     */
    public function getUserIdByUsername($username)
    {
        $user = $this->model->select('id', 'username')->where('username', '=', $username)->first();

        return $user;
    }

    /**
     * @return mixed
     */
    public function getAllActive()
    {
        return $this->model->where('is_active', '>=', '1')->get();
    }
}