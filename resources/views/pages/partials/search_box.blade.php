@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form class="form-inline my-2 my-lg-0"  method="POST" action="{{ route('queries.search') }}">
            {!! csrf_field() !!}
          <input class="form-control mr-sm-2" name="searchname" id="search" type="search" placeholder="Buscar productos...." autocomplete="off" size="80">
          <button class="btn btn-outline-success btn-sm" type="submit"><i class="material-icons">search</i></button>
</form>


<!-- {!! Form::open(array('route' => 'queries.search')) !!}
    <div class="typeahead-container" id="typeahead-container">
        <div class="typeahead-field">
            <span class="typeahead-query" id="typeahead-query">
                {!! Form::text('search', null, array('id' => 'flyer-query', 'placeholder' => 'Buscar productos...', 'autocomplete' =>'off')) !!}
            </span>
            {!! Form::submit('Buscar', ['id' => 'Search-Btn']) !!}
        </div>
    </div>
{!! Form::close() !!} -->
