@extends('template')

<style type="text/css">
    .guide-item{
        margin-bottom: 25px;
    }

</style>


@section('content')
    <div class="container">
        <div class="jumbotron">
            <h1>Multilanguage Installation Guide</h1>
            <p>Laravel project to work multilanguages translations with a final system. You cand download all the files required by clicking on the Download button below. </p>

            <p><a href="{{url('/download/multilang-files.zip')}}" class="btn btn-primary btn-large" style="color: white;">Download</a></p>
        </div>

        <div class="row guide-item">
            <h2>Set your configurations for this project</h2>

            <div class="col-md-12">
                <p>
                    First of all, configure this project on the .env file, with your connections to the database of the final project.
                </p>
            </div>
        </div>

        <div class="row guide-item">
            <h2>Create Migrations</h2>
            
            <div class="col-md-12">
                <p>
                    For this project to work, you need to create and run the respective migrations (or just create the tables on the database). Just substitutes the function up in each migration.
                </p>

                <h5>Languages migration</h5>
                <div class="col-md-12">
                    <p>
                        <pre>
                            <code id="code-html" class="code php" data-clipboard-target="#code-html">
                                public function up()
                                {
                                        Schema::create('languages', function (Blueprint &#36;table) {
                                            &#36;table&#45;>increments('id');
                                            &#36;table&#45;>string('code');
                                            &#36;table&#45;>string('name');
                                            &#36;table&#45;>integer('active');
                                            &#36;table&#45;>timestamps();
                                        });
                                }
                            </code>
                        </pre>
                    </p>
                </div>


                <h5>Modules migration</h5>
                <div class="col-md-12">
                    <p>
                        <pre>
                            <code id="code-html" class="code php" data-clipboard-target="#code-html">
                                public function up()
                                {
                                        Schema::create('modules', function (Blueprint &#36;table) {
                                            &#36;table&#45;>increments('id');
                                            &#36;table&#45;>string('name');
                                            &#36;table&#45;>timestamps();
                                        });
                                }
                            </code>
                        </pre>
                    </p>
                </div>


                <h5>Items migration</h5>
                <div class="col-md-12">
                    <p>
                        <pre>
                            <code id="code-html" class="code php" data-clipboard-target="#code-html">
                                public function up()
                                {
                                        Schema::create('items', function (Blueprint &#36;table) {
                                            &#36;table&#45;>increments('id');
                                            &#36;table&#45;>integer('id_module');
                                            &#36;table&#45;>string('name');
                                            &#36;table&#45;>string('description');
                                            &#36;table&#45;>timestamps();
                                        });
                                }
                            </code>
                        </pre>
                    </p>
                </div>


                <h5>Translations migration</h5>
                <div class="col-md-12">
                    <p>
                        <pre>
                            <code id="code-html" class="code php" data-clipboard-target="#code-html">
                                public function up()
                                {
                                        Schema::create('translations', function (Blueprint &#36;table) {
                                            &#36;table&#45;>increments('id');
                                            &#36;table&#45;>integer('id_language');
                                            &#36;table&#45;>integer('id_item');
                                            &#36;table&#45;>text('value');
                                            &#36;table&#45;>timestamps();
                                        });
                                }
                            </code>
                        </pre>
                    </p>
                </div>
            </div>
        </div>


        <div class="row guide-item">
            <h2>Create Models</h2>
            
            <div class="col-md-12">
                <p>
                    For each of migration/table, create the respective model. After all, you should have the Language, Module, Item and Translation models.
                </p>
            </div>
        </div>


        <div class="row guide-item">
            <h2>Add the translation function to the Translation model</h2>
            
            <div class="col-md-12">
                <p>
                    The core of the system is the funcion getTranslation($item), wich you need to include in your Translation model to call it from the blade view.
                </p>

                <pre>
                    <code id="code-html" class="code php" data-clipboard-target="#code-html">
                            public static function getTranslation(&#36;item){

                                &#36;language = Language::where('active',1)->first();
                                &#36;item = Item::where('name', &#36;item)->first();

                                if (&#36;language && $item) {

                                    &#36;translation = Translation::where(['id_language' => &#36;language->id, 'id_item' => &#36;item->id])->first();

                                    if(&#36;translation){
                                        return $translation->value;
                                    }
                                }

                                return '';
                            }
                    </code>
                </pre>
            </div>
        </div>


        <div class="row guide-item">
            <h2>Print the items in your views</h2>
            
            <div class="col-md-12">
                <p>
                    After you create the modules and items with their translations, you can use the function passing the item name as parameter, in your view to get the text in the language in which the system is actually running.
                </p>

                <pre>
                    <code id="code-html" class="code php" data-clipboard-target="#code-html">
                        &lt;div&gt;
                            &lt;p&gt;
                                &#123;&#123;App&#92;Translation&#58;&#58;getTranslation&#40;&#39;item_name&#39;&#41;&#125;&#125;
                            &lt;/p&gt;
                        &lt;/div&gt;
                    </code>
                </pre>
            </div>
        </div>

    </div>
@endsection


@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('pre code').each(function(i, block) {
                hljs.highlightBlock(block);
            });
        });
    </script>
@endsection