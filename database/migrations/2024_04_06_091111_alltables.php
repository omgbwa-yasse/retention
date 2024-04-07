<?php

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
        // Create rule table
        Schema::create('rule', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 100)->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Create user_login table
        Schema::create('user_login', function (Blueprint $table) {
            $table->increments('id');
            $table->string('login', 50)->nullable();
            $table->string('password', 50)->nullable();
            $table->string('sand', 255)->nullable();
            $table->timestamps();
        });

        // Create user_address table
        Schema::create('user_address', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email1', 100)->unique();
            $table->string('email2', 100)->nullable();
            $table->string('phone1', 20);
            $table->string('phone2', 20)->nullable();
            $table->string('country', 20);
            $table->string('town', 20);
            $table->string('address', 50);
            $table->timestamps();
        });

        // Create user table
        Schema::create('user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->string('surname', 50)->nullable();
            $table->string('gender', 10);
            $table->date('date_birth');
            $table->unsignedInteger('user_login_id');
            $table->unsignedInteger('user_address_id');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('user_login_id')->references('id')->on('user_login')->onDelete('cascade');
            $table->foreign('user_address_id')->references('id')->on('user_address')->onDelete('cascade');
        });

        // Create trigger table
        Schema::create('trigger', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 5)->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Create sort table
        Schema::create('sort', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 50)->unique();
            $table->string('description', 500)->nullable();
            $table->timestamps();
        });

        // Create dul table
        Schema::create('dul', function (Blueprint $table) {
            $table->increments('id');
            $table->string('duration', 50)->unique();
            $table->text('description')->nullable();
            $table->unsignedInteger('trigger_id');
            $table->unsignedInteger('sort_id');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('trigger_id')->references('id')->on('trigger')->onDelete('cascade');
            $table->foreign('sort_id')->references('id')->on('sort')->onDelete('cascade');
        });

        // Create reference_category table
        Schema::create('reference_category', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 50);
            $table->timestamps();
        });

        // Create reference table
        Schema::create('reference', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 50)->unique();
            $table->string('description', 500)->nullable();
            $table->string('file_crypt', 500)->nullable();
            $table->unsignedInteger('typology_id');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('typology_id')->references('id')->on('reference_category')->onDelete('cascade');
        });

        // Create reference_ressource table
        Schema::create('reference_ressource', function (Blueprint $table) {
            $table->unsignedInteger('reference_id');
            $table->unsignedInteger('ressource_id');
            $table->primary(['reference_id', 'ressource_id']);
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('reference_id')->references('id')->on('reference')->onDelete('cascade');
            $table->foreign('ressource_id')->references('id')->on('ressource')->onDelete('cascade');
        });

        // Create ressource table
        Schema::create('ressource', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 100);
            $table->string('description', 500);
            $table->string('link', 255);
            $table->string('file_path', 255);
            $table->string('file_crypt', 255)->nullable();
            $table->timestamps();
        });



        // Create typology_category table
        Schema::create('typology_category', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 50)->unique();
            $table->text('description')->nullable();
            $table->unsignedInteger('category_parent_id')->nullable();
            $table->timestamps();

        });

        // Create typology table
        Schema::create('typology', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 50)->unique();
            $table->text('description')->nullable();
            $table->unsignedInteger('typology_category_id');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('typology_category_id')->references('id')->on('typology_category')->onDelete('cascade');
        });


        // Create classification table
        Schema::create('classification', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cote', 10);
            $table->string('title', 50)->unique();
            $table->unsignedInteger('parent_id')->nullable();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('parent_id')->references('id')->on('classification')->onDelete('cascade');
        });

        // Create communicability table
        Schema::create('communicability', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 3)->unique();
            $table->string('title', 50)->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Create state table
        Schema::create('state', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 50)->nullable();
            $table->timestamps();
        });

        // Create rule_dul table
        Schema::create('rule_dul', function (Blueprint $table) {
            $table->unsignedInteger('dul_id');
            $table->unsignedInteger('rule_id');
            $table->text('description')->nullable();
            $table->primary(['dul_id', 'rule_id']);
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('dul_id')->references('id')->on('dul')->onDelete('cascade');
            $table->foreign('rule_id')->references('id')->on('rule')->onDelete('cascade');
        });

        // Create rule_classification table
        Schema::create('rule_classification', function (Blueprint $table) {
            $table->unsignedInteger('classe_id');
            $table->unsignedInteger('rule_id');
            $table->timestamps();
            $table->primary(['classe_id', 'rule_id']);

            // Foreign key constraints
            $table->foreign('classe_id')->references('id')->on('classification')->onDelete('cascade');
            $table->foreign('rule_id')->references('id')->on('rule')->onDelete('cascade');
        });

        // Create classification_communicability table
        Schema::create('classification_communicability', function (Blueprint $table) {
            $table->unsignedInteger('classification_id');
            $table->unsignedInteger('communicability_id');
            $table->primary(['classification_id', 'communicability_id']);

            // Foreign key constraints
            $table->foreign('classification_id')->references('id')->on('classification')->onDelete('cascade');
            $table->foreign('communicability_id')->references('id')->on('communicability')->onDelete('cascade');
        });

        // Create dul_reference table
        Schema::create('dul_reference', function (Blueprint $table) {
            $table->unsignedInteger('dul_id');
            $table->unsignedInteger('reference_id');
            $table->primary(['dul_id', 'reference_id']);

            // Foreign key constraints
            $table->foreign('dul_id')->references('id')->on('dul')->onDelete('cascade');
            $table->foreign('reference_id')->references('id')->on('reference')->onDelete('cascade');
        });

        // Create dua table
        Schema::create('dua', function (Blueprint $table) {
            $table->increments('id');
            $table->string('duration', 50)->unique();
            $table->text('description')->nullable();
            $table->unsignedInteger('trigger_id');
            $table->unsignedInteger('sort_id');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('trigger_id')->references('id')->on('trigger')->onDelete('cascade');
            $table->foreign('sort_id')->references('id')->on('sort')->onDelete('cascade');
        });

        // Create rule_dua table
        Schema::create('rule_dua', function (Blueprint $table) {
            $table->unsignedInteger('rule_id');
            $table->unsignedInteger('dua_id');
            $table->text('description')->nullable();
            $table->primary(['rule_id', 'dua_id']);
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('rule_id')->references('id')->on('rule')->onDelete('cascade');
            $table->foreign('dua_id')->references('id')->on('dua')->onDelete('cascade');
        });

        // Create active table
        Schema::create('active', function (Blueprint $table) {
            $table->increments('id');
            $table->string('duration', 50);
            $table->text('description')->nullable();
            $table->unsignedInteger('trigger_id');
            $table->unsignedInteger('sort_id');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('trigger_id')->references('id')->on('trigger')->onDelete('cascade');
            $table->foreign('sort_id')->references('id')->on('sort')->onDelete('cascade');
        });

        // Create rule_active table
        Schema::create('rule_active', function (Blueprint $table) {
            $table->unsignedInteger('active_id');
            $table->unsignedInteger('rule_id');
            $table->datetime('datetime');
            $table->text('description')->nullable();
            $table->primary(['active_id', 'rule_id']);

            // Foreign key constraints
            $table->foreign('active_id')->references('id')->on('active')->onDelete('cascade');
            $table->foreign('rule_id')->references('id')->on('rule')->onDelete('cascade');
        });

        // Create rule_state table
        Schema::create('rule_state', function (Blueprint $table) {
            $table->unsignedInteger('state_id');
            $table->unsignedInteger('rule_id');
            $table->primary(['state_id', 'rule_id']);
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('state_id')->references('id')->on('state')->onDelete('cascade');
            $table->foreign('rule_id')->references('id')->on('rule')->onDelete('cascade');
        });

        // Create forum_subject table
        Schema::create('forum_subject', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 50)->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Create forum_amswer table
        Schema::create('forum_amswer', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 50);
            $table->unsignedInteger('parent_id')->nullable();
            $table->unsignedInteger('subject_id');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('subject_id')->references('id')->on('forum_subject')->onDelete('cascade');
        });

        // Create forum_reaction_type table
        Schema::create('forum_reaction_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 50)->unique();
            $table->string('url', 255)->nullable();
            $table->timestamps();
        });

        // Create forum_subject_classification table
        Schema::create('forum_subject_classification', function (Blueprint $table) {
            $table->unsignedInteger('subjet_id');
            $table->unsignedInteger('classification_id');
            $table->primary(['subjet_id', 'classification_id']);

            // Foreign key constraints
            $table->foreign('subjet_id')->references('id')->on('forum_subject')->onDelete('cascade');
            $table->foreign('classification_id')->references('id')->on('classification')->onDelete('cascade');
        });

        // Create user_subject table
        Schema::create('user_subject', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('subject_id');
            $table->primary(['user_id', 'subject_id']);
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('forum_subject')->onDelete('cascade');
        });

        // Create user_amswer table
        Schema::create('user_amswer', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('amswer_id');
            $table->primary(['user_id', 'amswer_id']);

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('amswer_id')->references('id')->on('forum_amswer')->onDelete('cascade');
        });

        // Create forum_reaction_amswer table
        Schema::create('forum_reaction_amswer', function (Blueprint $table) {
            $table->unsignedInteger('reaction_type_id');
            $table->unsignedInteger('amswer_id');
            $table->unsignedInteger('user_id');
            $table->primary(['reaction_type_id', 'amswer_id']);
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('reaction_type_id')->references('id')->on('forum_reaction_type')->onDelete('cascade');
            $table->foreign('amswer_id')->references('id')->on('forum_amswer')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
        });

        // Create classification_typology table
        Schema::create('classification_typology', function (Blueprint $table) {
            $table->unsignedInteger('activity_id');
            $table->unsignedInteger('typology_id');
            $table->primary(['activity_id', 'typology_id']);

            // Foreign key constraints
            $table->foreign('activity_id')->references('id')->on('classification')->onDelete('cascade');
            $table->foreign('typology_id')->references('id')->on('typology')->onDelete('cascade');
        });

        Schema::create('user_rule', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('rule_id');
            $table->primary(['user_id', 'rule_id']);

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('rule_id')->references('id')->on('rule')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('user');
        Schema::dropIfExists('user_address');
        Schema::dropIfExists('user_login');
        Schema::dropIfExists('rule');
        Schema::dropIfExists('typology');
        Schema::dropIfExists('typology_category');
        Schema::dropIfExists('reference');
        Schema::dropIfExists('reference_category');
        Schema::dropIfExists('reference_ressource');
        Schema::dropIfExists('ressource');
        Schema::dropIfExists('dul');
        Schema::dropIfExists('sort');
        Schema::dropIfExists('trigger');
        Schema::dropIfExists('dul_reference');
        Schema::dropIfExists('classification_communicability');
        Schema::dropIfExists('rule_classification');
        Schema::dropIfExists('rule_dul');
        Schema::dropIfExists('state');
        Schema::dropIfExists('communicability');
        Schema::dropIfExists('classification');
        Schema::dropIfExists('forum_reaction_type');
        Schema::dropIfExists('forum_amswer');
        Schema::dropIfExists('forum_subject');
        Schema::dropIfExists('rule_state');
        Schema::dropIfExists('rule_active');
        Schema::dropIfExists('active');
        Schema::dropIfExists('rule_dua');
        Schema::dropIfExists('dua');
        Schema::dropIfExists('classification_typology');
        Schema::dropIfExists('forum_reaction_amswer');
        Schema::dropIfExists('user_amswer');
        Schema::dropIfExists('user_subject');
        Schema::dropIfExists('forum_subject_classification');
        Schema::dropIfExists('user_rule');
    }
};
