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



        // Create user_address table
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('email1', 100)->unique();
            $table->string('email2', 100)->nullable();
            $table->string('phone1', 20);
            $table->string('phone2', 20)->nullable();
            $table->string('town', 20);
            $table->string('address', 10);
            $table->unsignedInteger('user_id');
            $table->unsignedBigInteger('country_id');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
        });




        /*



           Références



        */



        Schema::create('references', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->string('description', 100)->nullable();
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('country_id');
            $table->unsignedInteger('user_id');
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('reference_categories')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->index(['name', 'category_id']);
        });


        Schema::create('reference_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->text('description');
            $table->timestamps();
        });


        Schema::create('reference_country', function (Blueprint $table) {
            $table->unsignedInteger('country_id');
            $table->unsignedInteger('reference_id');
            $table->primary(['country_id', 'reference_id']);
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->foreign('reference_id')->references('id')->on('references')->onDelete('cascade');
        });


        Schema::create('reference_links', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->nullable();
            $table->string('link', 255);
            $table->unsignedInteger('reference_id');
            $table->unsignedInteger('user_id');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('reference_id')->references('id')->on('references')->onDelete('cascade');
            $table->index('reference_id');
        });


        Schema::create('reference_files', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->nullable();
            $table->string('file_path', 255)->nullable();
            $table->string('file_crypt', 255)->nullable();
            $table->unsignedInteger('reference_id');
            $table->unsignedInteger('user_id');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('reference_id')->references('id')->on('references')->onDelete('cascade');
            $table->index('reference_id');
        });




        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('reference', 10)->unique();
            $table->string('name', 255)->nullable();
            $table->string('description', 100)->nullable();
            $table->unsignedInteger('reference_id');
            $table->unsignedInteger('user_id');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
            $table->foreign('activity_id')->references('id')->on('classifications')->onDelete('cascade');
            $table->foreign('typology_id')->references('id')->on('typologies')->onDelete('cascade');
        });


        // Create classifications table
        Schema::create('classifications', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10);
            $table->string('name', 100)->unique();
            $table->text('description')->nullable();
            $table->unsignedInteger('parent_id')->nullable();
            $table->unsignedInteger('country_id');
            $table->unsignedInteger('user_id');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('classifications')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
        });

        // Create communicabilities table
        Schema::create('communicabilities', function (Blueprint $table) {
            $table->id();
            $table->string('code', 3)->unique();
            $table->string('name', 100)->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Create classification_communicability table
        Schema::create('classification_communicability', function (Blueprint $table) {
            $table->unsignedInteger('classification_id');
            $table->unsignedInteger('communicability_id');
            $table->primary(['classification_id', 'communicability_id']);
            $table->foreign('classification_id')->references('id')->on('classifications')->onDelete('cascade');
            $table->foreign('communicability_id')->references('id')->on('communicabilities')->onDelete('cascade');
        });


        // Create communicabilities table
        Schema::create('classification_orders', function (Blueprint $table) {
            $table->id();
            $table->string('description', 10);
            $table->unsignedInteger('order_id');
            $table->unsignedInteger('classification_id');
            $table->unsignedInteger('user_id');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('classification_id')->references('id')->on('classifications')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });


        // Create communicabilities table
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->string('description', 10)->nullable();
            $table->unsignedInteger('user_id');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        /*



           Typologies



        */

        // Create typology_categories table
        Schema::create('typology_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->text('description')->nullable();
            $table->unsignedInteger('parent_id')->nullable();
            $table->unsignedInteger('user_id');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });




        // Create typologies table
        Schema::create('typologies', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->text('description')->nullable();
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('user_id');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('typology_categories')->onDelete('cascade');
        });





        /*



             Règles



        */


        // Create rule table
        Schema::create('rules', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10)->unique();
            $table->string('name', 100)->unique();
            $table->text('description')->nullable();
            $table->unsignedInteger('state_id');
            $table->unsignedInteger('country_id');
            $table->unsignedInteger('user_id');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
        });


        // Create active table
        Schema::create('actives', function (Blueprint $table) {
            $table->id();
            $table->string('duration', 10);
            $table->text('description')->nullable();
            $table->unsignedInteger('rule_id');
            $table->unsignedInteger('trigger_id');
            $table->unsignedInteger('sort_id');
            $table->unsignedInteger('country_id');
            $table->unsignedInteger('user_id');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('rule_id')->references('id')->on('rules')->onDelete('cascade');
            $table->foreign('trigger_id')->references('id')->on('triggers')->onDelete('cascade');
            $table->foreign('sort_id')->references('id')->on('sorts')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
        });


        // Create dua table
        Schema::create('duas', function (Blueprint $table) {
            $table->id();
            $table->string('duration', 10);
            $table->text('description')->nullable();
            $table->unsignedInteger('rule_id');
            $table->unsignedInteger('trigger_id');
            $table->unsignedInteger('sort_id');
            $table->unsignedInteger('country_id');
            $table->unsignedInteger('user_id');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('rule_id')->references('id')->on('rules')->onDelete('cascade');
            $table->foreign('trigger_id')->references('id')->on('triggers')->onDelete('cascade');
            $table->foreign('sort_id')->references('id')->on('sorts')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
        });


        // Create dul table
        Schema::create('duls', function (Blueprint $table) {
            $table->id();
            $table->string('duration', 10);
            $table->text('description')->nullable();
            $table->unsignedInteger('country_id');
            $table->unsignedInteger('rule_id');
            $table->unsignedInteger('trigger_id');
            $table->unsignedInteger('sort_id');
            $table->unsignedInteger('user_id');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('dul_id')->references('id')->on('duls')->onDelete('cascade');
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
        });


        // Create rule_classification table
        Schema::create('rule_classification', function (Blueprint $table) {
            $table->unsignedInteger('classification_id');
            $table->unsignedInteger('rule_id');
            $table->primary(['classification_id', 'rule_id']);
            $table->foreign('classification_id')->references('id')->on('classifications')->onDelete('cascade');
            $table->foreign('rule_id')->references('id')->on('rules')->onDelete('cascade');
        });



        // Create trigger table
        Schema::create('triggers', function (Blueprint $table) {
            $table->id();
            $table->string('code', 5)->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });


        // Create sort table
        Schema::create('sorts', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->string('description', 100)->nullable();
            $table->timestamps();
        });



        /*



             Baskets


        */


        // Create baskets
        Schema::create('baskets', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->text('description')->nullable();
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });


        // Create baskets types
        Schema::create('basket_types', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->timestamps();
        });


        // Create relation basket rule
        Schema::create('basket_rule', function (Blueprint $table) {
            $table->unsignedInteger('rule_id');
            $table->unsignedInteger('basket_id');
            $table->primary(['rule_id', 'basket_id']);
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('basket_id')->references('id')->on('baskets')->onDelete('cascade');
            $table->foreign('rule_id')->references('id')->on('rules')->onDelete('cascade');
        });



        // Create relation basket classification
        Schema::create('basket_classification', function (Blueprint $table) {
            $table->unsignedInteger('classification_id');
            $table->unsignedInteger('basket_id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->primary(['classification_id', 'basket_id']);
            $table->foreign('basket_id')->references('id')->on('baskets')->onDelete('cascade');
            $table->foreign('classification_id')->references('id')->on('classifications')->onDelete('cascade');
        });



        // Create relation basket reference
        Schema::create('basket_reference', function (Blueprint $table) {
            $table->unsignedInteger('basket_id');
            $table->unsignedInteger('reference_id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->primary(['reference_id', 'basket_id']);
            $table->foreign('basket_id')->references('id')->on('baskets')->onDelete('cascade');
            $table->foreign('reference_id')->references('id')->on('references')->onDelete('cascade');
        });
        /*



             Forum



        */

        // Create forum_subject table
        Schema::create('forum_subjects', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->text('description')->nullable();
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });


        // Create forum_amswer table
        Schema::create('forum_amswers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->unsignedInteger('parent_id')->nullable();
            $table->unsignedInteger('subject_id');
            $table->timestamps();
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('forum_subjects')->onDelete('cascade');
        });




        // Create forum_reaction_type table
        Schema::create('forum_reaction_types', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
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
            $table->id();
            $table->string('name', 100);
            $table->text('description')->nullable();
            $table->timestamps();
        });


        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('abbr', 10)->unique();
            $table->string('name', 100)->unique();
            $table->timestamps();
        });

    }



    /**
     * Reverse the migrations.
     */
    public function down()
    {

        Schema::dropIfExists('user_countries');
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


        Basket


        */
        Schema::dropIfExists('basket_reference');
        Schema::dropIfExists('basket_classification');
        Schema::dropIfExists('basket_rule');
        Schema::dropIfExists('basket_types');
        Schema::dropIfExists('baskets');
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
