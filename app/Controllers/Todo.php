<?php

namespace App\Controllers;

use App\Models\TaskModel;

class Todo extends BaseController
{
    protected $taskModel;

    public function __construct()
    {
        $this->taskModel = new TaskModel();
    }

    public function index()
    {
        $status = $this->request->getVar('status');
        $search = $this->request->getVar('search');

        $query = $this->taskModel;

        if ($status) {
            $query = $query->where('status', $status);
        }
        if ($search) {
            $query = $query->like('title', $search);
        }

        $data = [
            'tasks'          => $query->orderBy('created_at', 'DESC')->findAll(),
            'current_status' => $status ?? '',
            'current_search' => $search ?? ''
        ];
        return view('todo_view', $data);
    }

    public function create()
    {
        $title = $this->request->getPost('title');
        
        if (empty($title)) {
            return redirect()->back()->with('error', 'Judul tugas tidak boleh kosong!');
        }

        $this->taskModel->insert([
            'title'       => $title,
            'description' => $this->request->getPost('description'),
            'status'      => 'pending'
        ]);

        return redirect()->to('/')->with('success', 'Tugas baru berhasil ditambahkan!');
    }

    public function updateStatus($id, $status)
    {
        $this->taskModel->update($id, ['status' => $status]);
        
        $pesan = ($status == 'completed') ? 'Tugas berhasil diselesaikan!' : 'Tugas dikembalikan ke daftar aktif.';
        
        return redirect()->to('/')->with('success', $pesan);
    }

    public function delete($id)
    {
        $this->taskModel->delete($id);
        return redirect()->to('/')->with('success', 'Tugas berhasil dihapus dari sistem.');
    }
}