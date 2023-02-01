<?php

if (!empty($sello)){
    echo  '<p class="text-center" id="uploadForm"><img src="'.$sello['path'].'" class="img-thumbnail" width="300" height="300"></p>';
}else{
    echo '<p class="text-center" id="uploadForm">No se encuentra ningun sello registrado</p>';
}

?>