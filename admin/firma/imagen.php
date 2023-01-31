<?php

if (!empty($firmante['path_firma'])){
    echo  '<p class="text-center"><img src="'.$firmante['path_firma'].'" class="img-thumbnail"></p>';
}else{
    echo "no se que paso con el sello";
}
?>