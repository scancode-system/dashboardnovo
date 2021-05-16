	<div class="row">
	    <div class="col-md-6">
	        {{ Form::model($setting_pdf, ['route' => 'settings.pdf.update', 'method' => 'put']) }}
	        <div class="form-group">
	            {{ Form::label('title', 'Título impresso no pedido') }}
	            {{ Form::text('title', null, ['class' => 'form-control']) }}
	        </div>
	        <div class="form-group">
	            {{ Form::label('margin_top', 'Margem Top') }}
	            {{ Form::number('margin_top', null, ['class' => 'form-control']) }}
	        </div>
	        <div class="form-group">
	            {{ Form::label('global_observation', 'Observação') }}
	            {{ Form::textarea('global_observation', null, ['class' => 'form-control', 'placeholder' => '']) }}
	        </div>
	        <div class="form-group">
	            {{ Form::label('statement_responsibility', 'Termo') }}
	            {{ Form::textarea('statement_responsibility', null, ['class' => 'form-control', 'placeholder' => '']) }}
	        </div>
	        {{ Form::button('<i class="fa fa-save"></i><span>Salvar</span>', ['class' => 'btn btn-brand btn-primary', 'type' => 'submit']) }}
	        {{ Form::close() }}
	    </div>
	    <div class="col-md-6">
	        {{ Form::open(['route' => 'settings.pdf.columns.update', 'method' => 'put']) }}
	        @foreach($setting_pdf_columns as $setting_pdf_column)
	        <div class="form-group row">
	            {{ Form::label($setting_pdf_column->id, $setting_pdf_column->alias, ['class' => 'col-sm-4 col-form-label']) }}
	            <div class="col-sm-8">
	                <label class="c-switch c-switch-primary c-switch-lg mb-0 ml-3">
	                    {{ Form::hidden('setting_pdf_columns['.$setting_pdf_column->id.']', 0) }}
	                    {{ Form::checkbox('setting_pdf_columns['.$setting_pdf_column->id.']', 1, $setting_pdf_column->show,['class' => 'c-switch-input']) }}
	                    <span class="c-switch-slider"></span>
	                </label>
	            </div>
	        </div>
	        @endforeach
	        {{ Form::button('<i class="fa fa-save"></i><span>Salvar</span>', ['class' => 'btn btn-brand btn-primary', 'type' => 'submit']) }}
	        {{ Form::close() }}

	        <table class="table table-responsive-sm bg-white table-hover border mb-0 mt-3">
	            <thead>
	                <tr>
	                    <th>Titulo</th>
	                    <th>Descrição</th>
	                    <th>Ação</th>
	                </tr>
	            </thead>
	            <tbody>
	                @foreach($pdf_layouts as $pdf_layout)
	                <tr>
	                    <td class="align-middle">
	                        {{ $pdf_layout->title }}
	                    </td>
	                    <td class="align-middle">
	                        {{ $pdf_layout->description }}
	                    </td>
	                    <td class="align-middle">
	                        @if(!$pdf_layout->selected)
	                        {{ Form::open(['route' => ['settings.pdf.layouts.update', $pdf_layout], 'method' => 'put']) }}
	                        {{ Form::button('Selecionar', ['class' => 'btn btn-primary', 'type' => 'submit']) }}
	                        {{ Form::close() }}
	                        @else
	                        {{ Form::button('Selecionado', ['class' => 'btn btn-primary', 'type' => 'submit', 'disabled' => 'disabled']) }}
	                        @endif
	                    </td>
	                </tr>
	                @endforeach

	            </tbody>
	        </table>
	    </div>
	</div>