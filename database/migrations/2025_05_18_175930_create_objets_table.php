<?php
// Migrations de CRUD (Yahya)

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('objets', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('description');
            $table->string('lieu');
            $table->date('date_trouvaille');
            $table->string('photo')->nullable();
            $table->enum('categorie', ['vetement', 'electronique', 'cosmetique', 'document', 'autre']);
            $table->enum('statut', ['perdu', 'trouvé']);
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('objets');
    }
};
