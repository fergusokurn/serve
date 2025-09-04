<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('songs', function (Blueprint $table) {
            // Add new fields for the restructured form
            $table->string('nama_pic')->nullable()->after('nama_petugas');
            $table->string('nomor_telp')->nullable()->after('nama_pic');
            $table->time('waktu_tugas')->nullable()->after('tanggal_tugas');
            $table->string('sumber_lagu')->nullable()->after('judul_lagu');
            
            // Add fields for different song types
            $table->string('judul_lagu_pembuka')->nullable()->after('teks_lagu');
            $table->string('sumber_lagu_pembuka')->nullable()->after('judul_lagu_pembuka');
            $table->text('teks_lagu_pembuka')->nullable()->after('sumber_lagu_pembuka');
            
            $table->string('judul_lagu_persembahan')->nullable()->after('teks_lagu_pembuka');
            $table->string('sumber_lagu_persembahan')->nullable()->after('judul_lagu_persembahan');
            $table->text('teks_lagu_persembahan')->nullable()->after('sumber_lagu_persembahan');
            
            $table->string('judul_lagu_komuni')->nullable()->after('teks_lagu_persembahan');
            $table->string('sumber_lagu_komuni')->nullable()->after('judul_lagu_komuni');
            $table->text('teks_lagu_komuni')->nullable()->after('sumber_lagu_komuni');
            
            $table->string('judul_lagu_penutup')->nullable()->after('teks_lagu_komuni');
            $table->string('sumber_lagu_penutup')->nullable()->after('judul_lagu_penutup');
            $table->text('teks_lagu_penutup')->nullable()->after('sumber_lagu_penutup');
            
            // Add liturgical fields
            $table->text('tuhan_kasihanilah')->nullable()->after('teks_lagu_penutup');
            $table->text('kemuliaan')->nullable()->after('tuhan_kasihanilah');
            $table->text('kudus')->nullable()->after('kemuliaan');
            $table->text('anamnesis')->nullable()->after('kudus');
            $table->text('bapa_kami')->nullable()->after('anamnesis');
            $table->text('anak_domba_allah')->nullable()->after('bapa_kami');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('songs', function (Blueprint $table) {
            $table->dropColumn([
                'nama_pic',
                'nomor_telp',
                'waktu_tugas',
                'sumber_lagu',
                'judul_lagu_pembuka',
                'sumber_lagu_pembuka',
                'teks_lagu_pembuka',
                'judul_lagu_persembahan',
                'sumber_lagu_persembahan',
                'teks_lagu_persembahan',
                'judul_lagu_komuni',
                'sumber_lagu_komuni',
                'teks_lagu_komuni',
                'judul_lagu_penutup',
                'sumber_lagu_penutup',
                'teks_lagu_penutup',
                'tuhan_kasihanilah',
                'kemuliaan',
                'kudus',
                'anamnesis',
                'bapa_kami',
                'anak_domba_allah'
            ]);
        });
    }
};
