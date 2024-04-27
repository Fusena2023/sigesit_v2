<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class AutoCloseTicket extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'close:ticket';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make ticket in sigesit.big.go.id automatically close when more than 24 hours ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $datenow = date('Y-m-d');

        $layanan_jasa=DB::table('tiket')->where('kategori','jasa')->where('status',1)->get();

        foreach ($layanan_jasa as $val) {
            if($datenow > date($val->tanggal)){
                DB::table('tiket')->where('id',$val->id)->update(['status'=>2, 'closed_by' => 'Sistem']);
            }
        }
        
        $layanan_produk=DB::table('tiket')->where('kategori','produk')->where('status',1)->get();

        foreach ($layanan_produk as $val) {
            if($datenow > date($val->tanggal)){
                DB::table('tiket')->where('id',$val->id)->update(['status'=>2, 'closed_by' => 'Sistem']);
            }
        }

        $layanan_umum=DB::table('tiket')->where('kategori','umum')->where('status',1)->get();

        foreach ($layanan_umum as $val) {
            if($datenow > date($val->tanggal)){
                DB::table('tiket')->where('id',$val->id)->update(['status'=>2, 'closed_by' => 'Sistem']);
            }
        }
        
    }
}

