<?php
include dirname(__file__, 2) . '/modelo/menu.php';

/**
 *
 */
class MenuController extends MenuDao
{

    public function __construct()
    {
        # code...
    }

    public function getMenu()
    {
        //Instancia del DAO
        $menu = new MenuDAO();
        //Lista del menu Nivel 1
        $listaMenu = $menu->Menu();
        //Se recorre array de nivel 1
        for ($i = 0; $i < sizeof($listaMenu); $i++) {
            echo '<li class="nav-item dropdown">
                        <a aria-expanded="false" aria-haspopup="true" class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="navbarDropdown" role="button">
                            ' . $listaMenu[$i]["nombre_menu"] . '
                        </a>
                        <ul aria-labelledby="navbarDropdown" class="dropdown-menu">';

            //Lista del menu Nivel 2
            $itemsNivel2 = $menu->MenuNivel2($listaMenu[$i]["id_menu"]);

            //Se recorre array de nivel 2
            for ($j = 0; $j < sizeof($itemsNivel2); $j++) {
                echo '<li class="nav-item dropdown">
                                <a aria-expanded="false" aria-haspopup="true" class="dropdown-item dropdown-toggle" data-toggle="dropdown" href="#" id="navbarDropdown1" role="button">
                                    ' . $itemsNivel2[$j]["nombre_menu"] . '
                                </a>
                                <ul aria-labelledby="navbarDropdown1" class="dropdown-menu">';

                //Lista del menu Nivel 3
                $itemsNivel3 = $menu->MenuNivel3($itemsNivel2[$j]["id_menu"]);

                //Se recorre array de nivel 3
                for ($k = 0; $k < sizeof($itemsNivel3); $k++) {

                    echo '<li>
                        <a class="dropdown-item" href="' . $itemsNivel3[$k]["url_menu"] . '">
                        	' . $itemsNivel3[$k]["nombre_menu"] . '
                        </a>
                    </li>';

                }

                echo '</ul>
                            </li>';
            }

            echo '</ul>
                    </li>';
        }
    }
}
