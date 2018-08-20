

    <form class="form-inline nav-search"  method="POST" action="{{ route('queries.search') }}">
                    {!! csrf_field() !!}
                <input class="form-control mr-sm-2" name="searchname" id="search" type="search" placeholder="Buscar productos...." autocomplete="off" size="70">
                <button class="btn btn-outline-success btn-sm" type="submit"><i class="material-icons">search</i></button>
    </form>
