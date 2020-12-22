<?php 
  
use Illuminate\Support\Facades\Schema; 
use Illuminate\Database\Schema\Blueprint; 
use Illuminate\Database\Migrations\Migration; 
   
class CreatePointsTable extends Migration 
{ 
    /** 
     * Run the migrations. 
     * 
     * @return void 
     */ 
    public function up() 
    { 
        Schema::create('points', function (Blueprint $table) { 
            $table->bigIncrements('id'); 
            $table->string('name'); 
            $table->mediumText('text'); 
            $table->integer('QRnumber'); 
            $table->double('longitude');
            $table->double('latitude');
            $table->timestamps(); 
        }); 
    } 
   
    /** 
     * Reverse the migrations. 
     * 
     * @return void 
     */ 
    public function down() 
    { 
        Schema::dropIfExists('points'); 
    } 
} 