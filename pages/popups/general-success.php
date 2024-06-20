<button class="but_primary" onclick="window.location.reload();" style="margin-top: 1rem;">Begrepen</button>

<script>
    var allPpContainerContents = document.querySelectorAll('.pp_container-contents');
    var lastPpContainerContents = allPpContainerContents[allPpContainerContents.length - 1];
    lastPpContainerContents.removeChild(lastPpContainerContents.querySelector('button'));
</script>