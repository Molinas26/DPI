<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewDenunciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement(" CREATE VIEW view_denuncias AS
         SELECT denuncias.id, codigo, id_agente, nombres, apellidos, fecha_denuncia, telefono
        ,DATE_ADD(fecha_alternativa,INTERVAL dias DAY) AS fecha_vencimiento,
        DATEDIFF(DATE_ADD(fecha_alternativa,INTERVAL dias DAY), NOW())dias_faltantes,
        (SUM(a.estado)/COUNT(a.estado))*100 AS resultado,
        IF(((SUM(a.estado)/COUNT(a.estado))*100)>=100, 'Completado',
        IF((DATEDIFF(DATE_ADD(fecha_alternativa,INTERVAL dias DAY), NOW()))<0, 'Retrasada', 'Pendiente')
        ) AS estado, remitida, fecha_remitido, catalogo_accions.accion, denuncias.accion AS acci,
		   if(remitida <> 1, dias, 'completada' ) as dias
        FROM denuncias
        JOIN seguimientos a ON a.id_denuncia = denuncias .id
        JOIN agentes ON denuncias.id_agente=agentes.id
        JOIN catalogo_accions ON catalogo_accions.id = denuncias.accion
        GROUP BY (denuncias.id)
        ORDER BY fecha_denuncia DESC ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW view_denuncias");
    }
}
