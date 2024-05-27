<?php
    $currantLang = \Auth::user()->lang;
?>
<form action="" id="myForm">
    <?php echo csrf_field(); ?>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <?php echo e(Form::label('template', __('For What'), ['class' => 'col-form-label'])); ?></br>
                <?php $__currentLoopData = $templateName; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input template_name" type="radio" name="template_name"
                            value="<?php echo e($value->id); ?>" id="product_name_<?php echo e($value->id); ?>"
                            data-name="<?php echo e($value->template_name); ?>">
                        <label class="form-check-label" for="product_name_<?php echo e($value->id); ?>">
                            <?php echo e(ucwords(str_replace('_', ' ', $value->template_name))); ?>

                            
                        </label>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <?php echo e(Form::label('language', __('Language'), ['class' => 'col-form-label'])); ?>

                <select name="language" class="form-select" id="language">
                    <?php $__currentLoopData = App\Models\Utility::flagOfCountry(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($key); ?>" <?php echo e($currantLang == $key ? 'selected' : ''); ?>>
                            <?php echo e(Str::upper($lang)); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>


        <div class="col-6 tone">
            <div class="form-group">
                <?php echo e(Form::label('', __('Tone'), ['class' => 'col-form-label'])); ?>

                <?php
                    $tone = [
                        'funny' => 'funny',
                        'casual' => 'casual',
                        'excited' => 'excited',
                        'professional' => 'professional',
                        'witty' => 'witty',
                        'sarcastic' => 'sarcastic',
                        'feminine' => 'feminine',
                        'masculine' => 'masculine',
                        'bold' => 'bold',
                        'dramatic' => 'dramatic',
                        'gumpy' => 'gumpy',
                        'secretive' => 'secretive',
                    ];
                ?>
                <?php echo e(Form::select('tone', $tone, null, ['class' => 'form-control'])); ?>

            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <?php echo e(Form::label('', __('AI Creativity'), ['class' => 'col-form-label'])); ?>

                <select name="ai_creativity" id="ai_creativity" class="form-select">
                    <option value="1"><?php echo e(__('High')); ?></option>
                    <option value="0.5"><?php echo e(__('Meduium')); ?></option>
                    <option value="0"><?php echo e(__('Low')); ?></option>
                </select>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <?php echo e(Form::label('', __('Number of Result'), ['class' => 'col-form-label'])); ?>

                <select name="num_of_result" id="" class="form-select">
                    <?php for($i = 1; $i <= 10; $i++): ?>
                        <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                    <?php endfor; ?>
                </select>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <?php echo e(Form::label('', __('Maximum Result Length'), ['class' => 'col-form-label'])); ?>

                <?php echo e(Form::number('result_length', 10, ['class' => 'form-control'])); ?>

            </div>
        </div>
        <div class="col-12" id="getkeywords">
        </div>

    </div>
    <div class="form-group response">
        <a class="btn btn-primary btn-sm float-left" href="#!" id="generate"><?php echo e(__('Generate')); ?></a>
        <a href="#!" onclick="copyText()" class="btn btn-primary btn-sm float-end"><i
                class="ti ti-copy"></i><?php echo e(__('Copy Text')); ?></a>
        <a href="#!" onclick="copySelectedText()" class="btn btn-primary btn-sm float-end me-2 selected_text"><i
                class="ti ti-copy"></i><?php echo e(__('Copy Selected Text')); ?></a>
    </div>
</form>
<div class="form-group mt-3">
    <?php echo e(Form::textarea('description', null, ['class' => 'form-control', 'rows' => 5, 'placeholder' => __('Description'), 'id' => 'ai-description'])); ?>

</div>


<script>
    function copyText() {
        var selected = $('input[name="template_name"]:checked').attr('data-name');
        var copied = $("#ai-description").val();

        var input = $('input[name=' + selected + ']').length;
        if (input > 0) {
            $('input[name=' + selected + ']').val(copied)
        } else {

            if ($('textarea[name=' + selected + ']').hasClass('summernote-simple') || $('textarea[name=' + selected +
                    ']').hasClass('summernote-simple-2')) {

                $('textarea[name=' + selected + ']').summernote("code", copied);
            } else {
                $('textarea[name=' + selected + ']').val(copied)
            }
        }
        show_toastr('success', 'Result text has been copied successfully', 'success');
        $('#commonModalOver').modal('hide');
    }

    function copySelectedText() {
        var selected = $('input[name="template_name"]:checked').attr('data-name');
        var selectedText = window.getSelection().toString();
        var input = $('input[name=' + selected + ']').length;
        $('#ai-description').after("Copied to clipboard");
        if (input > 0) {
            $('input[name=' + selected + ']').val(selectedText)
        } else {
            if ($('textarea[name=' + selected + ']').hasClass('summernote-simple') || $('textarea[name=' + selected +
                    ']').hasClass('summernote-simple-2')) {
                $('textarea[name=' + selected + ']').summernote("code", selectedText);
            } else {
                $('textarea[name=' + selected + ']').val(selectedText)
            }

        }
        show_toastr('success', 'Result text has been copied successfully', 'success');
        $('#commonModalOver').modal('hide');

    }
    $('body').on('shown.bs.modal', function() {
        $("#commonModalOver input:radio:first").prop("checked", true).trigger("change");
    });
    $('body').on('change', '.template_name', function() {
        var templateId = $(this).val();
        var url =
            $.ajax({
                type: 'post',
                url: '<?php echo e(route('generate.keywords', ['__templateId'])); ?>'.replace('__templateId',
                    templateId),
                datType: 'json',
                data: {
                    '_token': '<?php echo e(csrf_token()); ?>',
                    'template_id': templateId,
                },
                success: function(data) {
                    if (data.tone == 1) {
                        $('.tone').removeClass('d-none');
                        $('.tone select').attr('name', 'tone');
                    } else {
                        $('.tone').addClass('d-none');
                        $('.d-none select').removeAttr('name');
                    }
                    $('#getkeywords').empty();
                    $('#getkeywords').append(data.template)
                },
            })
    })
    $('body').on('click', '#generate', function() {
        var form = $("#myForm");
        $.ajax({
            type: 'post',
            url: '<?php echo e(route('generate.response')); ?>',
            datType: 'json',
            data: form.serialize(),
            beforeSend: function(msg) {
                $("#generate").empty();
                var html = '<span class="spinner-grow spinner-grow-sm" role="status"></span>';
                $("#generate").append(html);
            },
            afterSend: function(msg) {
                $("#generate2").empty();
                var html =
                    `<a class="btn btn-primary" href="#!" id="generate"><?php echo e(__('Generate')); ?></a>`;
                $("#generate2").replaceWith(html);

            },
            success: function(data) {
                $('.response').removeClass('d-none');
                $('#generate').text('Re-Generate');
                if (data.message) {
                    show_toastr('error', data.message, 'error');
                    $('#commonModalOver').modal('hide');
                } else {
                    $('#ai-description').val(data)
                }
            },
        });
    });
</script>
<?php /**PATH /media/yash/New Volume/OFFICE/HRMS/hrmgosaas-61nulled/codecanyon-25982934-hrmgo-saas-hrm-and-payroll-tool/main-file/resources/views/template/generate.blade.php ENDPATH**/ ?>