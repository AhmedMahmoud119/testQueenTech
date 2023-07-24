<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogFileController extends Controller
{

    public function file(Request $request)
    {
        $lines = file('../' . $request->file_path);

        $limit = 10;
        $pages_limit = ceil(count($lines) / $limit);
        $offset = (($request->page ?? 1) * $limit) - $limit;

        $lines = array_slice($lines, $offset, $limit);

        $current_page = $request->page ?? 1;

        if ($current_page == $pages_limit) {
            $next_page = $current_page;
        } else {
            $next_page = $current_page + 1;
        }

        if ($current_page == 1) {
            $previous_page = $current_page;
        } else {
            $previous_page = $current_page - 1;
        }

        return response()->json([
            'lines'         => $lines,
            'first_page'    => 1,
            'last_page'     => $pages_limit,
            'next_page'     => $next_page,
            'previous_page' => $previous_page,
            'start_column'  => $offset + 1,
        ]);
    }
}
