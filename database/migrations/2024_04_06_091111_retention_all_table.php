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
            $table->text('description')->nullable();
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




        Schema::create('reference_articles', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20)->unique();
            $table->string('name', 255)->nullable();
            $table->text('description');
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
            $table->string('name', 100);
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
        $table->string('duration', 10);
        $table->unsignedInteger('trigger_id');
        $table->unsignedInteger('sort_id');
        $table->unsignedInteger('status_id')->default(1);
        $table->unsignedInteger('country_id');
        $table->unsignedInteger('user_id');
        $table->unsignedInteger('validated_by')->nullable();
        $table->dateTime('validated_at')->nullable();
        $table->timestamps();
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('status_id')->references('id')->on('statuses')->onDelete('cascade');
        $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
        $table->foreign('validated_by')->references('id')->on('users')->onDelete('set null');
    });

        // Create dul_article table
        Schema::create('rule_articles', function (Blueprint $table) {
            $table->unsignedInteger('rule_id');
            $table->unsignedInteger('article_id');
            $table->primary(['rule_id', 'article_id']);
            $table->unsignedInteger('user_id');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('rule_id')->references('id')->on('rules')->onDelete('cascade');
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
        });


        // Create rule_classification table
        Schema::create('rule_classifications', function (Blueprint $table) {
            $table->unsignedInteger('classification_id');
            $table->unsignedInteger('rule_id');
            $table->primary(['classification_id', 'rule_id']);
            $table->foreign('classification_id')->references('id')->on('classifications')->onDelete('cascade');
            $table->foreign('rule_id')->references('id')->on('rules')->onDelete('cascade');
        });



        // Create trigger table
        Schema::create('triggers', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10)->unique();
            $table->string('name', 100)->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });


        // Create sort table
        Schema::create('sorts', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10)->unique();
            $table->string('name', 100)->unique();
            $table->text('description');
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
            $table->unsignedInteger('type_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('basket_types')->onDelete('cascade');
            $table->timestamps();
        });


        // Create baskets types
        Schema::create('basket_types', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->timestamps();
        });



        /*



             Forum



        */

        // Create forum_subject table
        Schema::create('forum_subjects', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });

        // Create forum_post table
        Schema::create('forum_posts', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('subject_id');
            $table->timestamps();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('forum_subjects')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('forum_posts')->onDelete('cascade');
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
            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('classification_id');
            $table->primary(['subject_id', 'classification_id']);
            // Foreign key constraints
            $table->foreign('subject_id')->references('id')->on('forum_subjects')->onDelete('cascade');
            $table->foreign('classification_id')->references('id')->on('classifications')->onDelete('cascade');
        });

        // Create user_subject table
        Schema::create('user_subject', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('subject_id');
            $table->primary(['user_id', 'subject_id']);
            $table->timestamps();
            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('forum_subjects')->onDelete('cascade');
        });

        // Create user_post table
        Schema::create('user_post', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('post_id');
            $table->primary(['user_id', 'post_id']);
            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('post_id')->references('id')->on('forum_posts')->onDelete('cascade');
        });

        // Create forum_reaction_posts table
        Schema::create('forum_reaction_posts', function (Blueprint $table) {
            $table->unsignedBigInteger('reaction_type_id');
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('user_id');
            $table->primary(['reaction_type_id', 'post_id']);
            $table->timestamps();
            // Foreign key constraints
            $table->foreign('reaction_type_id')->references('id')->on('forum_reaction_types')->onDelete('cascade');
            $table->foreign('post_id')->references('id')->on('forum_posts')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });





        /*





            CHAT






        */



        Schema::create('chat_types', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['individual', 'group'])->default('individual'); // Type de conversation
            $table->timestamps();
        });


        Schema::create('chat_participants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Suppression en cascade si l'utilisateur est supprimé
            $table->foreignId('conversation_id')->constrained()->onDelete('cascade');
            $table->timestamp('last_read')->nullable();
            $table->timestamps();
        });


        Schema::create('chat_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conversation_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('content');
            $table->enum('type', ['text', 'image', 'video', 'audio'])->default('text'); // Type de message
            $table->boolean('read')->default(false); // Statut de lecture
            $table->timestamps();
        });



        /*



                Setting



        */



        // Create state table
        Schema::create('statuses', function (Blueprint $table) {
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


        // news
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->boolean('published')->default(true);
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
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
        Schema::dropIfExists('reference_articles');
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
        Schema::dropIfExists('dul_articles');
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
        Schema::dropIfExists('forum_reaction_posts');
        Schema::dropIfExists('user_post');
        Schema::dropIfExists('user_subject');
        Schema::dropIfExists('forum_subject_classification');
        Schema::dropIfExists('forum_reaction_types');
        Schema::dropIfExists('forum_posts');
        Schema::dropIfExists('forum_subjects');


        /*



        CHAT


        */

        Schema::dropIfExists('chat_types');
        Schema::dropIfExists('chat_messages');
        Schema::dropIfExists('chat_participants');


        /*



        Setting



        */
        Schema::dropIfExists('countries');
        Schema::dropIfExists('statuses');


        /*

        News

        */

        Schema::dropIfExists('news');
    }
};
