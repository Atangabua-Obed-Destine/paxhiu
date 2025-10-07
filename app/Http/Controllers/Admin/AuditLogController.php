<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    public function index()
    { 
        $data['title'] = 'Audit Logs';
        $data['route'] = 'admin.audit-logs';
        $data['view'] = 'admin.audit-log';

        $data['auditLogs'] = AuditLog::with('user')->latest()->paginate(25);

        return view('admin.audit-log.index', $data);
    }
}