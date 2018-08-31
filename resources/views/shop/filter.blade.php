<style>
#menu * { list-style:none; height: 100%;}
#menu li{ line-height:180%;}
#menu li a{color:#222; text-decoration:none;}
#menu li a:before{ content:"\025b8"; color:#ddd; margin-right:1px;}
#menu input[name="list"] {
	position: absolute;
	left: -1000em;
	}
#menu label:before{ /*content:"\025b8";*/ margin-right:1px;}
/*#menu input:checked ~ label:before{ content:"\025be";}*/
#menu .interior{display: none;}
#menu input:checked ~ ul{display:block;}
right {
}
</style>

<div class="col-12 col-sm-12 col-md-12 col-lg-12">
    <ul id="menu" style="width: 280px;">
        <li class="list-group-item"><input type="checkbox" name="list" id="nivel1-1"><label for="nivel1-1">Ordenar</label>
            <ul class="interior">
                <li><a href="#r">Populares</a></li>
                <li><a href="#r">Menor Precio</a></li>
                <li><a href="#r">Mayor Precio</a></li>
            </ul>
        </li>
        <li class="list-group-item"><input type="checkbox" name="list" id="nivel1-2" checked=""><label for="nivel1-2">Filtros</label>
            <ul class="interior">
                <li><input type="checkbox" name="list" id="nivel2-6"><label for="nivel2-6">Marca</label>
                    <ul class="interior">
                        <li><input type="checkbox" aria-label="Checkbox for following text input"><a href="#r">Microsoft</a></li>
                        <li><input type="checkbox" aria-label="Checkbox for following text input"><a href="#r">Apple</a></li>
                        <li><input type="checkbox" aria-label="Checkbox for following text input"><a href="#r">Toshiba</a></li>
                    </ul>
                </li>
                <li><input type="checkbox" name="list" id="nivel2-4"><label for="nivel2-4">Precio</label>
                    <ul class="interior">
                        <li><a href="#r">Menor a $200</a></li>
                        <li><a href="#r">Mayor a $200</a></li>
                    </ul>
                </li>
                <li><input type="checkbox" name="list" id="nivel2-5"><label for="nivel2-5">Calificación</label>
                    <ul class="interior">
                        <li><a href="#r">*</a></li>
                        <li><a href="#r">**</a></li>
                        <li><a href="#r">***</a></li>
                        <li><a href="#r">****</a></li>
                        <li><a href="#r">*****</a></li>
                    </ul>
                </li>
                <li><input type="checkbox" name="list" id="nivel2-6"><label for="nivel2-6">Populares</label>
                    <ul class="interior">
                        <li><a href="#r">#</a></li>
                        <li><a href="#r">#</a></li>
                        <li><a href="#r">#</a></li>
                    </ul>
                </li>
                <li><input type="checkbox" name="list" id="nivel2-7"><label for="nivel2-7">Existencia</label>
                    <ul class="interior">
                        <li><a href="#r">10</a></li>
                        <li><a href="#r">50</a></li>
                        <li><a href="#r">100</a></li>
                    </ul>
                </li>
            </ul>
        </li>
    </ul>
</div>
