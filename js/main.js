document.addEventListener('DOMContentLoaded', () => {
  
  const formAppearance = document.querySelector('._form-appearance')
  formAppearance.style = `
    opacity: 1;
    transition: opacity 1s ease;
  `
  
  const toPricesBtn = document.querySelector('._scroll-to-prices')
  const secondSection = document.querySelector('._sc-2')
  toPricesBtn.addEventListener('click', () => {
    secondSection.scrollIntoView({ behavior: "smooth", block: "start" })
  })
  
  const toFormBtn = document.querySelector('._scroll-to-form')
  const thirdSection = document.querySelector('._sc-3')
  toFormBtn.addEventListener('click', () => {
    thirdSection.scrollIntoView({ behavior: "smooth", block: "start" })
  })
  
  const nums = [...document.querySelectorAll('._strInt-to-format')]
  nums.map(num => {
    num.innerText = new Intl.NumberFormat("ru", {style: "decimal"}).format(num.innerText)
  })
  
  
  const submitBtn = document.getElementById("submitBtn")
  submitBtn.addEventListener('click', submitForm)
  function submitForm() {
    const name = document.getElementById("name").value
    let phone = document.getElementById("phone").value
    const email = document.getElementById("email").value
    
    const regExp = /\+| |\(|\)|\-/g;
    phone = phone.replace(regExp, '')
    
    const xhr = new XMLHttpRequest()
    const url = "query.php"
    const params = "name=" + name + "&phone=" + phone + "&email=" + email
    xhr.open("POST", url, true)
    
    // добавляем заголовок для отправки формы
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
    
    xhr.onreadystatechange = function() {
        formAppearance.style.opacity = 0
      
        // Установка обработчика события transitionend
        function handleTransitionEnd() {
          const styles = `
            display: flex;
            align-items: center;
            justify-content: center;
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            opacity: 0;
            transition: opacity 1s ease-in;
          `
          let message
          if (xhr.readyState == 4 && xhr.status == 200) {
            message= `
              <div class="message-appearance">Ваша заявка успешно отправлена!</div>
            `
          } else {
            message= `
              <div class="message-appearance message-appearance--error">Ошибка сервера! Попробуйте перезагрузить страницу и/или попробовать позже.</div>
            `
          }
          
          formAppearance.insertAdjacentHTML('afterend', `
            <div class="_message-appearance" style="${styles}">
                ${message}
            </div>
          `)
          
          const messageAppearance = document.querySelector('._message-appearance')
          setTimeout(() => {
            messageAppearance.style.opacity = '1'
          }, 10)
        
          // Удаление обработчика события transitionend после его использования
          formAppearance.removeEventListener('transitionend', handleTransitionEnd);
        }
      
        formAppearance.addEventListener('transitionend', handleTransitionEnd);
    }
    
    xhr.send(params)
  }
  
  function maskPhone(selector, masked = '+7 (___) ___-__-__') {
    const elems = document.querySelectorAll(selector);
    
    function mask(event) {
      const keyCode = event.keyCode;
      const template = masked,
        def = template.replace(/\D/g, ""),
        val = this.value.replace(/\D/g, "");
      console.log(template);
      let i = 0,
        newValue = template.replace(/[_\d]/g, function (a) {
          return i < val.length ? val.charAt(i++) || def.charAt(i) : a;
        });
      i = newValue.indexOf("_");
      if (i !== -1) {
        newValue = newValue.slice(0, i);
      }
      let reg = template.substr(0, this.value.length).replace(/_+/g,
        function (a) {
          return "\\d{1," + a.length + "}";
        }).replace(/[+()]/g, "\\$&");
      reg = new RegExp("^" + reg + "$");
      if (!reg.test(this.value) || this.value.length < 5 || keyCode > 47 && keyCode < 58) {
        this.value = newValue;
      }
      if (event.type === "blur" && this.value.length < 5) {
        this.value = "";
      }
      
    }
    
    for (const elem of elems) {
      elem.addEventListener("input", mask);
      elem.addEventListener("focus", mask);
      elem.addEventListener("blur", mask);
    }
    
  }
  maskPhone(".sign-up-form__input[type='tel']")
})
