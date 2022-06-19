<script src="https://cdn.tiny.cloud/1/zeum3erxsd01ubbkdu7rw5nzbbbcdgjnuq03spraimddo9pp/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
  tinymce.init({
      selector: 'textarea',
      plugins: 'a11ychecker advcode casechange export formatpainter image editimage linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tableofcontents tinycomments tinymcespellchecker',
      toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter image editimage pageembed permanentpen table tableofcontents',
      toolbar_mode: 'floating',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',

      @if(Auth::user()->admin)
          file_picker_callback (callback, value, meta) {
              let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth
              let y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight

              tinymce.activeEditor.windowManager.openUrl({
                  url : '/file-manager/tinymce5',
                  title : 'Laravel File manager',
                  width : x * 0.8,
                  height : y * 0.8,
                  onMessage: (api, message) => {
                      callback(message.content, { text: message.text })
                  }
              })
          }
      @endif
  });
</script>
