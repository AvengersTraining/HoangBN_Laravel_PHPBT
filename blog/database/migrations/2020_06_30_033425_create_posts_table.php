<?php

namespace Migration;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('title', 255);
            $table->text('content');
            $table->string('thumbnail', 255);
            $table->integer('post_vote');
            $table->integer('post_view');
            $table->tinyInteger('is_published');
            $table->softDeletes(); // delete_at
            $table->timestamps(); // create_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
