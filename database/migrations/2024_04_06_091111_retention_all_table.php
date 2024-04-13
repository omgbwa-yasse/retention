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




        // Create user_rule table
        Schema::create('user_rule', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('rule_id');
            $table->primary(['user_id', 'rule_id']);
            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('rule_id')->references('id')->on('rules')->onDelete('cascade');
        });





        // Create user_address table
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->autoIncrement('id')->primary();
            $table->unsignedInteger('user_id');
            $table->string('email1', 100)->unique();
            $table->string('email2', 100)->nullable();
            $table->string('phone1', 20);
            $table->string('phone2', 20)->nullable();
            $table->string('country', 20);
            $table->string('town', 20);
            $table->string('address', 50);
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });




        /*



           Références



        */



        Schema::create('references', function (Blueprint $table) {
            $table->autoIncrement('id')->primary();
            $table->string('name', 50)->unique();
            $table->string('description', 500)->nullable();
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('country_id');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('category_id')->references('id')->on('reference_categories')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->index(['name', 'category_id']);
        });


        Schema::create('reference_categories', function (Blueprint $table) {
            $table->autoIncrement('id')->primary();
            $table->string('name', 50)->unique();
            $table->text('description');
            $table->timestamps();
        });


        Schema::create('reference_country', function (Blueprint $table) {
            $table->unsignedInteger('country_id');
            $table->unsignedInteger('reference_id');
            $table->primary(['country_id', 'reference_id']);
            // Foreign key constraints
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->foreign('reference_id')->references('id')->on('references')->onDelete('cascade');
        });


        Schema::create('reference_links', function (Blueprint $table) {
            $table->autoIncrement('id')->primary();
            $table->string('name', 100);
            $table->string('link', 255)->nullable();
            $table->unsignedInteger('reference_id');
            $table->timestamps();

            $table->foreign('reference_id')->references('id')->on('references')->onDelete('cascade');
            $table->index('reference_id');
        });


        Schema::create('reference_files', function (Blueprint $table) {
            $table->autoIncrement('id')->primary();
            $table->string('name', 100)->nullable();
            $table->string('file_path', 255)->nullable();
            $table->string('file_crypt', 255)->nullable();
            $table->unsignedInteger('reference_id');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('reference_id')->references('id')->on('references')->onDelete('cascade');
            $table->index('reference_id');
        });




        Schema::create('articles', function (Blueprint $table) {
            $table->autoIncrement('id')->primary();
            $table->string('reference', 50)->unique();
            $table->string('name', 255)->nullable();
            $table->string('description', 500)->nullable();
            $table->unsignedInteger('reference_id');
            $table->timestamps();
            // Foreign key constraints
            $table->foreign('reference_id')->references('id')->on('references')->onDelete('cascade');
        });




        /*



            Classifications



        */



        // Create classification_typology table
        Schema::create('classification_typology', function (Blueprint $table) {
            $table->unsignedInteger('activity_id');
            $table->unsignedInteger('typology_id');
            $table->primary(['activity_id', 'typology_id']);
            // Foreign key constraints
            $table->foreign('activity_id')->references('id')->on('classifications')->onDelete('cascade');
            $table->foreign('typology_id')->references('id')->on('typologies')->onDelete('cascade');
        });




        // Create classifications table
        Schema::create('classifications', function (Blueprint $table) {
            $table->autoIncrement('id')->primary();
            $table->string('cote', 10);
            $table->string('name', 50)->unique();
            $table->unsignedInteger('parent_id')->nullable();
            $table->timestamps();
            // Foreign key constraint
            $table->foreign('parent_id')->references('id')->on('classifications')->onDelete('cascade');
        });

        // Create communicabilities table
        Schema::create('communicabilities', function (Blueprint $table) {
            $table->autoIncrement('id')->primary();
            $table->string('code', 3)->unique();
            $table->string('name', 50)->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Create classification_communicability table
        Schema::create('classification_communicability', function (Blueprint $table) {
            $table->unsignedInteger('classification_id');
            $table->unsignedInteger('communicability_id');
            $table->primary(['classification_id', 'communicability_id']);
            // Foreign key constraints
            $table->foreign('classification_id')->references('id')->on('classifications')->onDelete('cascade');
            $table->foreign('communicability_id')->references('id')->on('communicabilities')->onDelete('cascade');
        });


        // Create communicabilities table
        Schema::create('classification_orders', function (Blueprint $table) {
            $table->autoIncrement('id')->primary();
            $table->string('description', 50);
            $table->unsignedInteger('order_id');
            $table->unsignedInteger('classification_id');
            $table->timestamps();
            // Foreign key constraints
            $table->foreign('classification_id')->references('id')->on('classifications')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });


        // Create communicabilities table
        Schema::create('orders', function (Blueprint $table) {
            $table->autoIncrement('id')->primary();
            $table->string('name', 50)->unique();
            $table->string('description', 50)->nullable();
            $table->timestamps();
        });



        /*



           Typologies



        */





        // Create typology_categories table
        Schema::create('typology_categories', function (Blueprint $table) {
            $table->autoIncrement('id')->primary();
            $table->string('name', 50)->unique();
            $table->text('description')->nullable();
            $table->unsignedInteger('parent_id')->nullable();
            $table->timestamps();

        });




        // Create typologies table
        Schema::create('typologies', function (Blueprint $table) {
            $table->autoIncrement('id')->primary();
            $table->string('name', 50)->unique();
            $table->text('description')->nullable();
            $table->unsignedInteger('category_id');
            $table->timestamps();
            // Foreign key constraint
            $table->foreign('category_id')->references('id')->on('typology_categories')->onDelete('cascade');
        });





        /*



             Règles



        */


        // Create rule table
        Schema::create('rules', function (Blueprint $table) {
            $table->autoIncrement('id')->primary();
            $table->string('name', 100)->unique();
            $table->text('description')->nullable();
            $table->unsignedInteger('state_id');
            $table->timestamps();
            // Foreign key constraints
            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
        });


        // Create active table
        Schema::create('actives', function (Blueprint $table) {
            $table->autoIncrement('id')->primary();
            $table->string('duration', 50);
            $table->text('description')->nullable();
            $table->unsignedInteger('rule_id');
            $table->unsignedInteger('trigger_id');
            $table->unsignedInteger('sort_id');
            $table->timestamps();
            // Foreign key constraints
            $table->foreign('rule_id')->references('id')->on('rules')->onDelete('cascade');
            $table->foreign('trigger_id')->references('id')->on('triggers')->onDelete('cascade');
            $table->foreign('sort_id')->references('id')->on('sorts')->onDelete('cascade');
        });


        // Create dua table
        Schema::create('duas', function (Blueprint $table) {
            $table->autoIncrement('id')->primary();
            $table->string('duration', 50);
            $table->text('description')->nullable();
            $table->unsignedInteger('rule_id');
            $table->unsignedInteger('trigger_id');
            $table->unsignedInteger('sort_id');
            $table->timestamps();
            // Foreign key constraints
            $table->foreign('rule_id')->references('id')->on('rules')->onDelete('cascade');
            $table->foreign('trigger_id')->references('id')->on('triggers')->onDelete('cascade');
            $table->foreign('sort_id')->references('id')->on('sorts')->onDelete('cascade');
        });


        // Create dul table
        Schema::create('duls', function (Blueprint $table) {
            $table->autoIncrement('id')->primary();
            $table->string('duration', 50);
            $table->text('description')->nullable();
            $table->unsignedInteger('country_id');
            $table->unsignedInteger('rule_id');
            $table->unsignedInteger('trigger_id');
            $table->unsignedInteger('sort_id');
            $table->timestamps();
            // Foreign key constraints
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->foreign('rule_id')->references('id')->on('rules')->onDelete('cascade');
            $table->foreign('trigger_id')->references('id')->on('triggers')->onDelete('cascade');
            $table->foreign('sort_id')->references('id')->on('sorts')->onDelete('cascade');
        });



        // Create dul_article table
        Schema::create('dul_article', function (Blueprint $table) {
            $table->unsignedInteger('dul_id');
            $table->unsignedInteger('article_id');
            $table->primary(['dul_id', 'article_id']);
            // Foreign key constraints
            $table->foreign('dul_id')->references('id')->on('duls')->onDelete('cascade');
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
        });


        // Create rule_classification table
        Schema::create('rule_classification', function (Blueprint $table) {
            $table->unsignedInteger('classification_id');
            $table->unsignedInteger('rule_id');
            $table->primary(['classification_id', 'rule_id']);
            // Foreign key constraints
            $table->foreign('classification_id')->references('id')->on('classifications')->onDelete('cascade');
            $table->foreign('rule_id')->references('id')->on('rules')->onDelete('cascade');
        });



        // Create trigger table
        Schema::create('triggers', function (Blueprint $table) {
            $table->autoIncrement('id')->primary();
            $table->string('code', 5)->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });


        // Create sort table
        Schema::create('sorts', function (Blueprint $table) {
            $table->autoIncrement('id')->primary();
            $table->string('name', 50)->unique();
            $table->string('description', 500)->nullable();
            $table->timestamps();
        });





        /*



             Forum



        */




        // Create forum_subject table
        Schema::create('forum_subjects', function (Blueprint $table) {
            $table->autoIncrement('id')->primary();
            $table->string('name', 50)->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });


        // Create forum_amswer table
        Schema::create('forum_amswers', function (Blueprint $table) {
            $table->autoIncrement('id')->primary();
            $table->string('name', 50);
            $table->unsignedInteger('parent_id')->nullable();
            $table->unsignedInteger('subject_id');
            $table->timestamps();
            // Foreign key constraints
            $table->foreign('subject_id')->references('id')->on('forum_subjects')->onDelete('cascade');
        });




        // Create forum_reaction_type table
        Schema::create('forum_reaction_types', function (Blueprint $table) {
            $table->autoIncrement('id')->primary();
            $table->string('name', 50)->unique();
            $table->string('url', 255)->nullable();
            $table->timestamps();
        });



        // Create forum_subject_classification table
        Schema::create('forum_subject_classification', function (Blueprint $table) {
            $table->unsignedInteger('subjet_id');
            $table->unsignedInteger('classification_id');
            $table->primary(['subjet_id', 'classification_id']);
            // Foreign key constraints
            $table->foreign('subjet_id')->references('id')->on('forum_subjects')->onDelete('cascade');
            $table->foreign('classification_id')->references('id')->on('classifications')->onDelete('cascade');
        });




        // Create user_subject table
        Schema::create('user_subject', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('subject_id');
            $table->primary(['user_id', 'subject_id']);
            $table->timestamps();
            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('forum_subjects')->onDelete('cascade');
        });


        // Create user_amswer table
        Schema::create('user_amswer', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('amswer_id');
            $table->primary(['user_id', 'amswer_id']);
            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('amswer_id')->references('id')->on('forum_amswers')->onDelete('cascade');
        });


        // Create forum_reaction_amswers table
        Schema::create('forum_reaction_amswers', function (Blueprint $table) {
            $table->unsignedInteger('reaction_type_id');
            $table->unsignedInteger('amswer_id');
            $table->unsignedInteger('user_id');
            $table->primary(['reaction_type_id', 'amswer_id']);
            $table->timestamps();
            // Foreign key constraints
            $table->foreign('reaction_type_id')->references('id')->on('forum_reaction_types')->onDelete('cascade');
            $table->foreign('amswer_id')->references('id')->on('forum_amswers')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });



        /*



                Setting



        */



        // Create state table
        Schema::create('states', function (Blueprint $table) {
            $table->autoIncrement('id')->primary();
            $table->string('name', 50);
            $table->text('description')->nullable();
            $table->timestamps();
        });


        Schema::create('countries', function (Blueprint $table) {
            $table->autoIncrement('id')->primary();
            $table->string('name', 50)->unique();
            $table->timestamps();
        });

    }



    /**
     * Reverse the migrations.
     */
    public function down()
    {

        Schema::dropIfExists('user_rule');
        Schema::dropIfExists('user_addresses');


        /*

        Références

        */


        Schema::dropIfExists('references');
        Schema::dropIfExists('reference_files');
        Schema::dropIfExists('reference_links');
        Schema::dropIfExists('reference_country');
        Schema::dropIfExists('reference_categories');
        Schema::dropIfExists('articles');

        /*

        classifications

        */

        Schema::dropIfExists('classifications');
        Schema::dropIfExists('classification_typology');
        Schema::dropIfExists('typologies');
        Schema::dropIfExists('typology_categories');
        Schema::dropIfExists('typologies');
        Schema::dropIfExists('typology_categories');
        Schema::dropIfExists('classification_communicability');
        Schema::dropIfExists('communicabilities');
        Schema::dropIfExists('classification_orders');
        Schema::dropIfExists('orders');


        /*

        Rule

        */


        Schema::dropIfExists('rules');
        Schema::dropIfExists('rule_classification');
        Schema::dropIfExists('dul_article');
        Schema::dropIfExists('duls');
        Schema::dropIfExists('duas');
        Schema::dropIfExists('actives');
        Schema::dropIfExists('triggers');
        Schema::dropIfExists('sorts');


        /*

        Forum

        */

        Schema::dropIfExists('forum_reaction_amswers');
        Schema::dropIfExists('user_amswer');
        Schema::dropIfExists('user_subject');
        Schema::dropIfExists('forum_subject_classification');
        Schema::dropIfExists('forum_reaction_types');
        Schema::dropIfExists('forum_amswers');
        Schema::dropIfExists('forum_subjects');


        /*

        Setting

        */


        Schema::dropIfExists('countries');
        Schema::dropIfExists('states');

    }
};
