// CKEditor 5 - Local UMD build initialization

function initCKEditor5(selector, options = {}) {
    const editorClass = (typeof ClassicEditor !== 'undefined') ? ClassicEditor : (typeof CKEDITOR !== 'undefined' ? CKEDITOR.ClassicEditor : null);
    if (!editorClass) {
        console.warn('CKEditor 5 not loaded. Skipping editor initialization.');
        return;
    }

    const defaultConfig = {
        licenseKey: 'GPL',
        toolbar: {
            items: [
                'heading',
                '|',
                'bold',
                'italic',
                'underline',
                'strikethrough',
                '|',
                'fontColor',
                'fontBackgroundColor',
                '|',
                'bulletedList',
                'numberedList',
                '|',
                'link',
                'insertTable',
                'blockQuote',
                '|',
                'undo',
                'redo'
            ],
            shouldNotGroupWhenFull: true
        },
        language: 'en',
        heading: {
            options: [
                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' }
            ]
        }
    };

    const config = Object.assign({}, defaultConfig, options);
    if (options.toolbar) {
        config.toolbar = Object.assign({}, defaultConfig.toolbar, options.toolbar);
    }

    const elements = document.querySelectorAll(selector);
    elements.forEach(function(element) {
        if (element.dataset.ckeditor5Init) return;
        element.dataset.ckeditor5Init = 'true';

        editorClass.create(element, config)
            .then(function(editor) {
                element.ckeditor5Instance = editor;

                const editorContainer = editor.ui.view.editable.element;
                if (editorContainer) {
                    editorContainer.style.minHeight = '250px';
                    editorContainer.style.maxHeight = '400px';
                    editorContainer.style.height = '300px';
                    editorContainer.style.overflow = 'auto';
                }
                const editorWrapper = editor.ui.view.element;
                if (editorWrapper) {
                    editorWrapper.style.minHeight = '350px';
                    editorWrapper.style.height = '350px';
                }
            })
            .catch(function(error) {
                console.error('CKEditor 5 initialization error:', error);
            });
    });
}

document.addEventListener('DOMContentLoaded', function() {
    initCKEditor5('.ckeditor5-editor');
});

function updateCKEditor5Elements(formSelector) {
    const form = document.querySelector(formSelector);
    if (!form) return;
    form.addEventListener('submit', function() {
        document.querySelectorAll('.ckeditor5-editor').forEach(function(element) {
            if (element.ckeditor5Instance) {
                element.value = element.ckeditor5Instance.getData();
            }
        });
    });
}
