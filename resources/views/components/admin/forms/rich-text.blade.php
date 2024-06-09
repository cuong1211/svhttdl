@props([
    'id',
    'value',
    'name',
    'model',
])

<x-trix-input
    id="{{ $id }}"
    name="{{ $name }}"
    value="{!! $value?->toTrixHtml() !!}"
    x-data="{
        upload(event) {
            const data = new FormData();
            data.append('attachment', event.attachment.file);
            data.append('model', '{{ $model }}');

            window.axios.post('{{ route('admin.rich-text.attachment') }}', data, {
                onUploadProgress(progressEvent) {
                    event.attachment.setUploadProgress(
                        progressEvent.loaded / progressEvent.total * 100
                    );
                },
            }).then(({ data }) => {
                event.attachment.setAttributes({
                    url: data.image_url,
                });
            });
        }
    }"
    x-on:trix-attachment-add="upload"
/>
<x-rich-text::styles theme="richtextlaravel" />
