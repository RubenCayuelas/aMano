
// Execute the script for first time.
charsCount(document.getElementById("descripcion"));
function charsCount(texarea) {
  let maxLength = 250;
  let strLength = texarea.value.length;
  let charRemain = (maxLength - strLength);

  if (charRemain <= 0) {
    document.getElementById("charNum").innerHTML = '<span style="color: red;">' + charRemain + '</span>';
  } else {
    document.getElementById("charNum").innerHTML = charRemain;
  }
}