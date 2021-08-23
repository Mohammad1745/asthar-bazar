<?php

namespace App\Modules\Contact\Repositories;

use App\Http\Repositories\CommonRepository;
use App\Models\ContactMessage;

class ContactMessageRepository extends CommonRepository
{
    public $model;

    /**
     * ContactMessageRepository constructor.
     */
    public function __construct()
    {
        $this->model = new ContactMessage();
        parent::__construct($this->model);
    }

    /**
     * @param $where
     * @return mixed
     */
    public function detail($where)
    {
        return ContactMessage::select([
            'contact_messages.id as id',
            'contact_messages.to as to',
            'contact_messages.message as message',
            'contact_messages.read as read',
            'contact_messages.replied_by as replied_by',
            'contact_messages.reply as reply',
            'users.first_name as first_name',
            'users.last_name as last_name',
            'users.email as email',
        ])
            ->leftjoin('users', ['contact_messages.user_id' => 'users.id'])
            ->where($where)
            ->first();
    }

    /**
     * @return mixed
     */
    public function detailQuery()
    {
        return ContactMessage::select([
            'contact_messages.id as id',
            'contact_messages.to as to',
            'contact_messages.message as message',
            'contact_messages.read as read',
            'contact_messages.replied_by as replied_by',
            'contact_messages.reply as reply',
            'users.first_name as first_name',
            'users.last_name as last_name',
            'users.email as email',
        ])
            ->leftjoin('users', ['contact_messages.user_id' => 'users.id']);
    }
}
