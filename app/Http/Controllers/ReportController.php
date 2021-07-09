<?php

namespace App\Http\Controllers;
use Gate;
use App\InvoiceDocument;
use App\Ticket;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            if (Gate::allows('generic-administration')) {

                // $users = User::count();
                // $tickets = Ticket::count();
                // $invoices = InvoiceDocument::count();
                // $tickets = Ticket::count();


                // DB::enableQueryLog();
                $result = DB::select("
                    SELECT
                        (SELECT COUNT(*) FROM users) as usuarios,
                        (SELECT COUNT(*) FROM tickets) as tickets,
                        (SELECT COUNT(*) FROM clients) as clientes,
                        (SELECT COUNT(*) FROM invoice_documents) as facturas,
                        (SELECT COUNT(*) FROM migrations) as migraciones
                ");
                // dd(DB::getQueryLog());

                return response()->json([
                    'counts' => $result
                    // 'users' => $users,
                    // 'tickets' => $tickets,
                    // 'invoices' => $invoices,
                    ]
                , 200);
            }
        } catch (\Exception $exception) {
            return response()->json([
                'err' => $exception->getMessage(),
                'message' => 'Error: You cannot show report.'
            ], 412);
        }
    }
}
