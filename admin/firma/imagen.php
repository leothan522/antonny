<?php

if (!empty($firmante['path_firma'])){
    echo  '<p class="text-center" id="uploadForm"><img src="'.$firmante['path_firma'].'" class="img-thumbnail" width="300" height="300"></p>';
}else{
    echo '<p class="text-center" id="uploadForm">No se encuentra ningun sello registrado</p>';
}

?>