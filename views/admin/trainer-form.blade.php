<!------------------------------------------------------------------------------
| List of elements in trainer form
|------------------------------------------------------------------------------->
{!! Form::open(['route' => ['trainer.trainer', 'id' => @$item->id], 'files' => true, 'method' => 'trainer']) !!}

<!--BUTTONS-->
<div class='btn-form'>
    <!-- DELETE BUTTON -->
    @if ($item)
        <a href="{!! URL::route('trainer.delete', ['id' => @$item->id, '_token' => csrf_token()]) !!}" class="btn btn-danger pull-right margin-left-5 delete">
            {!! trans($plang_admin . '.buttons.delete') !!}
        </a>
    @endif
    <!-- DELETE BUTTON -->

    <!-- SAVE BUTTON -->
    {!! Form::submit(trans($plang_admin . '.buttons.save'), ['class' => 'btn btn-info pull-right ']) !!}
    <!-- /SAVE BUTTON -->
</div>
<!--/BUTTONS-->

<!--TAB MENU-->
<ul class="nav nav-tabs">
    <!--BASIC-->
    <li class="active">
        <a data-toggle="tab" href="#menu_1">
            {!! trans($plang_admin . '.tabs.basic') !!}
        </a>
    </li>
</ul>
<!--/TAB MENU-->

<!--TAB CONTENT-->
<div class="tab-content">

    <!--BASIC-->
    <div id="menu_1" class="tab-pane fade in active">
        <!-- LIST OF CATEGORIES -->
        @include('package-category::admin.partials.select_single', [
        'name' => 'user',
        'label' => trans($plang_admin.'.labels.user'),
        'items' => $user,
        'value' => @$item->user_id,
        'description' => trans($plang_admin.'.descriptions.user'),
        'errors' => $errors,
        ])

        <!-- LIST OF CATEGORIES -->
        @include('package-category::admin.partials.select_single', [
        'name' => 'company_id',
        'label' => trans($plang_admin.'.labels.company'),
        'items' => $company,
        'value' => @$item->company_id,
        'description' => trans($plang_admin.'.descriptions.company'),
        'errors' => $errors,
        ])
        
        <!--STATUS-->
        @include('package-category::admin.partials.select_single', [
        'name' => 'trainer_status',
        'label' => trans($plang_admin.'.form.status'),
        'value' => @$item->trainer_status,
        'items' => $status,
        'description' => trans($plang_admin.'.descriptions.status'),
        ])

        <label style="display: flex;justify-items: center;margin-bottom:0;">
            <li class="list-group-item" style="display: flex;justify-items: center;border: none;width:100%;">
                {!! Form::checkbox('is_leader', '1', @$item->is_leader, ['style' => 'margin-right: 1rem;']) !!}
                Is leader
            </li>
        </label>
    </div>

</div>
<!--/TAB CONTENT-->

<!--HIDDEN FIELDS-->
<div class='hidden-field'>
    {!! Form::hidden('id', @$item->id) !!}
    {!! Form::hidden('context', $request->get('context', null)) !!}
</div>
<!--/HIDDEN FIELDS-->

{!! Form::close() !!}
<!------------------------------------------------------------------------------
| End list of elements in trainer form
|------------------------------------------------------------------------------>
