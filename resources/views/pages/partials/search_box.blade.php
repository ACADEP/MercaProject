


{!! Form::open(array('route' => 'queries.search')) !!}
    <div class="typeahead-container" id="typeahead-container">
        <div class="typeahead-field">
            <span class="typeahead-query" id="typeahead-query">
                {!! Form::text('search', null, array('id' => 'flyer-query', 'placeholder' => 'Buscar productos...', 'autocomplete' =>'off')) !!}
            </span>
            {!! Form::submit('Buscar', ['id' => 'Search-Btn']) !!}
        </div>
    </div>
{!! Form::close() !!}
