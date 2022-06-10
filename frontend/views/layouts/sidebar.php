<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="<?=$assetDir?>/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Anteproyecto de título</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
         <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src=" <?=$assetDir?>/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div> -->

        <!-- SidebarSearch Form -->
        <!-- href be escaped -->
        <!-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> -->

        <!-- Sidebar Menu -->
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            // menu de Profesor asignatura
            if (!Yii::$app->user->isGuest) {
                if (Yii::$app->user->identity->role == 1) {
                    echo \hail812\adminlte\widgets\Menu::widget([
                        'items' => [
                            ['label' => 'Proyectos', 'url' => ['proyecto/index'], 'iconStyle' => 'far'],
                            [
                                'label' => 'Actividades',
                                'iconStyle' => 'far',
                                'items' => [
                                    ['label' => 'Hitos', 'url' => ['hito/index'], 'iconStyle' => 'far'],
                                    ['label' => 'Módulos', 'url' => ['modulo/index'], 'iconStyle' => 'far'],
                                ]
                            ]
                        ]
                    ]);
                }
                
                
                // menu de Estudiante
                if (Yii::$app->user->identity->role == 2) {
                    echo \hail812\adminlte\widgets\Menu::widget([
                        'items' => [
                            ['label' => 'Proyectos', 'url' => ['proyecto/indexestudiante'], 'iconStyle' => 'far'],
                            ['label' => 'Hitos', 'url' => ['hito/indexestudiante'], 'iconStyle' => 'far'],
                            ['label' => 'Módulos', 'url' => ['modulo/indexestudiante'], 'iconStyle' => 'far'],
                        ]
                    ]);
                }
                // menu de Profesor ICINF
                if (Yii::$app->user->identity->role == 3 ) {
                    echo \hail812\adminlte\widgets\Menu::widget([
                        'items' => [
                            
                            ['label' => 'Proyectos', 'url' => ['proyecto/indexprofesor'], 'iconStyle' => 'far'],
                        ],
                            
                    ]);
                }

                // menu de Comisión evaluadora
                if (Yii::$app->user->identity->role == 4 ) {
                    echo \hail812\adminlte\widgets\Menu::widget([
                        'items' => [
                            ['label' => 'Proyectos', 'url' => ['proyecto/indexprofesor'], 'iconStyle' => 'far'],
                                
                            ],
                           
                    ]);
                }
                // menu de Jefatura de carrera
                if (Yii::$app->user->identity->role == 6) {
                    echo \hail812\adminlte\widgets\Menu::widget([
                        'items' => [
                            ['label' => 'Proyectos', 'url' => ['proyecto/indexprofesor'], 'iconStyle' => 'far'],  
                             
                        ]
                    ]);
                }
                //menu Profesor Guía
                if (Yii::$app->user->identity->role == 5) {
                    echo \hail812\adminlte\widgets\Menu::widget([
                        'items' => [
                            ['label' => 'Proyectos', 'url' => ['proyecto/indexestudiante'], 'iconStyle' => 'far'],
                            ['label' => 'Hitos', 'url' => ['hito/indexestudiante'], 'iconStyle' => 'far'],
                        ]  
                    ]);
                }
            }

            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

        
        
        
        
        
        
        
        
        
        
        
        
        
        <!--<nav class="mt-2">
        <!?php
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                   /* [
                        'label' => 'Starter Pages',
                        'icon' => 'tachometer-alt',
                        'badge' => '<span class="right badge badge-info">2</span>',
                        'items' => [
                            ['label' => 'Active Page', 'url' => ['site/index'], 'iconStyle' => 'far'],
                            ['label' => 'Inactive Page', 'iconStyle' => 'far'],
                        ]
                    ],*/
                    
                   /* ['label' => 'Yii2 PROVIDED', 'header' => true],
                    ['label' => 'Login', 'url' => ['site/login'], 'icon' => 'sign-in-alt', 'visible' => Yii::$app->user->isGuest],
                    ['label' => 'Gii',  'icon' => 'file-code', 'url' => ['/gii'], 'target' => '_blank'],
                    ['label' => 'Debug', 'icon' => 'bug', 'url' => ['/debug'], 'target' => '_blank'],*/

                    ['label' => 'DATOS CURSO', 'header' => true],
                    //['label' => 'Level1'],
                    [
                        'label' => 'Participantes',
                        
                    ],
                    [
                        'label' => 'Calendario',
                        
                    ],
                    [
                        'label' => 'Datos asignatura',
                        
                    ],



                    ['label' => 'USUARIOS', 'header' => true],
                    //['label' => 'Level1'],
                    [
                        'label' => 'Profesor asignatura',
                        'items' => [
                            ['label' => 'Proyectos', 'url' => ['proyecto/index'], 'iconStyle' => 'far'],
                            [
                                'label' => 'Actividades',
                                'iconStyle' => 'far',
                                'items' => [
                                    ['label' => 'Hitos', 'url' => ['hito/index'], 'iconStyle' => 'far'],
                                    ['label' => 'Módulos', 'url' => ['modulo/index'], 'iconStyle' => 'far'],
                                   
                                ]
                            ],

                        ]
                    ],
                    [
                        'label' => 'Estudiante',
                        'items' => [
                            //['label' => 'Level2', 'iconStyle' => 'far'],
                            ['label' => 'Proyectos', 'url' => ['proyecto/indexestudiante'], 'iconStyle' => 'far'],
                            ['label' => 'Hitos', 'url' => ['hito/indexestudiante'], 'iconStyle' => 'far'],
                            ['label' => 'Módulos', 'url' => ['modulo/indexestudiante'], 'iconStyle' => 'far'],
                           /* [
                                'label' => 'Level2',
                                'iconStyle' => 'far',
                                'items' => [
                                    ['label' => 'Level3', 'iconStyle' => 'far', 'icon' => 'dot-circle'],
                                    ['label' => 'Level3', 'iconStyle' => 'far', 'icon' => 'dot-circle'],
                                    ['label' => 'Level3', 'iconStyle' => 'far', 'icon' => 'dot-circle']
                                ]
                            ],*/
                            //['label' => 'Level2', 'iconStyle' => 'far']
                        ]
                    ],
                    [
                        'label' => 'Profesor ICINF',
                        'items' => [
                            ['label' => 'Proyectos', 'url' => ['proyecto/indexprofesor'], 'iconStyle' => 'far'],
                        ]
                    ],
                    [
                        'label' => 'Comisión ',
                        'items' => [
                            ['label' => 'Level2', 'iconStyle' => 'far'],
                            [
                                'label' => 'Level2',
                                'iconStyle' => 'far',
                                'items' => [
                                    ['label' => 'Level3', 'iconStyle' => 'far', 'icon' => 'dot-circle'],
                                    ['label' => 'Level3', 'iconStyle' => 'far', 'icon' => 'dot-circle'],
                                    ['label' => 'Level3', 'iconStyle' => 'far', 'icon' => 'dot-circle']
                                ]
                            ],
                            ['label' => 'Level2', 'iconStyle' => 'far']
                        ]
                    ],
                   // ['label' => 'Level1'],
                    ['label' => 'LABELS', 'header' => true],
                    ['label' => 'Important', 'iconStyle' => 'far', 'iconClassAdded' => 'text-danger'],
                    ['label' => 'Warning', 'iconClass' => 'nav-icon far fa-circle text-warning'],
                    ['label' => 'Informational', 'iconStyle' => 'far', 'iconClassAdded' => 'text-info'],
                ],
            ]);
            ?>
        </nav>-->
        <!-- /.sidebar-menu -->
    <!--</div>-->
    <!-- /.sidebar -->
<!--</aside>-->