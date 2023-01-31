<?php

if (!empty($sello)){
    echo  '<p class="text-center"><img src="'.$sello['path'].'" class="img-thumbnail"></p>';
}else{
    echo "No se encuentra ningun sello registrado";
}

?>