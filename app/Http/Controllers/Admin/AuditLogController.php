<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    public function index(Request $request)
    {
        $query = AuditLog::with('user')->orderBy('created_at', 'desc');

        // Filtering
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }
        if ($request->filled('action_type')) {
            $query->where('action_type', $request->action_type);
        }
        if ($request->filled('model_name')) {
            $query->where('model_name', $request->model_name);
        }
        if ($request->filled('from') && $request->filled('to')) {
            $query->whereBetween('created_at', [$request->from, $request->to]);
        }

        $logs = $query->paginate(20)->appends($request->query());

        return view('admin.audit_logs.index', compact('logs'));
    }

    public function show(AuditLog $auditLog)
    {
        return view('admin.audit_logs.show', compact('auditLog'));
    }
}
