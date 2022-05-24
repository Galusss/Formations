(function() {
  "use strict";

  /**
   * Easy selector helper function
   */
  const select = (el, all = false) => {
    el = el.trim()
    if (all) {
      return [...document.querySelectorAll(el)]
    } else {
      return document.querySelector(el)
    }
  }

  /**
   * Easy event listener function
   */
  const on = (type, el, listener, all = false) => {
    let selectEl = select(el, all)
    if (selectEl) {
      if (all) {
        selectEl.forEach(e => e.addEventListener(type, listener))
      } else {
        selectEl.addEventListener(type, listener)
      }
    }
  }

  /**
   * Easy on scroll event listener 
   */
  const onscroll = (el, listener) => {
    el.addEventListener('scroll', listener)
  }

  /**
   * Navbar links active state on scroll
   */
  let navbarlinks = select('#navbar .scrollto', true)
  const navbarlinksActive = () => {
    let position = window.scrollY + 200
    navbarlinks.forEach(navbarlink => {
      if (!navbarlink.hash) return
      let section = select(navbarlink.hash)
      if (!section) return
      if (position >= section.offsetTop && position <= (section.offsetTop + section.offsetHeight)) {
        navbarlink.classList.add('active')
      } else {
        navbarlink.classList.remove('active')
      }
    })
  }
  window.addEventListener('load', navbarlinksActive)
  onscroll(document, navbarlinksActive)

  /**
   * Scrolls to an element with header offset
   */
  const scrollto = (el) => {
    let header = select('#header')
    let offset = header.offsetHeight

    if (!header.classList.contains('header-scrolled')) {
      offset -= 20
    }

    let elementPos = select(el).offsetTop
    window.scrollTo({
      top: elementPos - offset,
      behavior: 'smooth'
    })
  }

  /**
   * Toggle .header-scrolled class to #header when page is scrolled
   */
  let selectHeader = select('#header')
  if (selectHeader) {
    const headerScrolled = () => {
      if (window.scrollY > 100) {
        selectHeader.classList.add('header-scrolled')
      } else {
        selectHeader.classList.remove('header-scrolled')
      }
    }
    window.addEventListener('load', headerScrolled)
    onscroll(document, headerScrolled)
  }

  /**
   * Back to top button
   */
  let backtotop = select('.back-to-top')
  if (backtotop) {
    const toggleBacktotop = () => {
      if (window.scrollY > 100) {
        backtotop.classList.add('active')
      } else {
        backtotop.classList.remove('active')
      }
    }
    window.addEventListener('load', toggleBacktotop)
    onscroll(document, toggleBacktotop)
  }

  /**
   * Mobile nav toggle
   */
  on('click', '.mobile-nav-toggle', function(e) {
    select('#navbar').classList.toggle('navbar-mobile')
    this.classList.toggle('bi-list')
    this.classList.toggle('bi-x')
  })

  /**
   * Mobile nav dropdowns activate
   */
  on('click', '.navbar .dropdown > a', function(e) {
    if (select('#navbar').classList.contains('navbar-mobile')) {
      e.preventDefault()
      this.nextElementSibling.classList.toggle('dropdown-active')
    }
  }, true)

  /**
   * Scrool with ofset on links with a class name .scrollto
   */
  on('click', '.scrollto', function(e) {
    if (select(this.hash)) {
      e.preventDefault()

      let navbar = select('#navbar')
      if (navbar.classList.contains('navbar-mobile')) {
        navbar.classList.remove('navbar-mobile')
        let navbarToggle = select('.mobile-nav-toggle')
        navbarToggle.classList.toggle('bi-list')
        navbarToggle.classList.toggle('bi-x')
      }
      scrollto(this.hash)
    }
  }, true)

  /**
   * Scroll with ofset on page load with hash links in the url
   */
  window.addEventListener('load', () => {
    if (window.location.hash) {
      if (select(window.location.hash)) {
        scrollto(window.location.hash)
      }
    }
  });

})()

  /**
   * Modals with Bootstrap
   */

  // Movies Modal
  var moviesModal = document.getElementById('moviesModal')
  moviesModal.addEventListener('show.bs.modal', function (event) {

    // Button that triggered the modal
    var button = event.relatedTarget

    // Extract info from data-bs-* attributes
    var title = button.getAttribute('data-bs-title')
    var imgSrc = button.getAttribute('data-bs-img')
    var imgAlt = button.getAttribute('data-bs-imgAlt')
    var description = button.getAttribute('data-bs-description')
    var producer = button.getAttribute('data-bs-producer')
    var scenario = button.getAttribute('data-bs-scenario')
    var actors = button.getAttribute('data-bs-actors')
    var release = button.getAttribute('data-bs-release')
    var type = button.getAttribute('data-bs-type')
    var duration = button.getAttribute('data-bs-duration')
    var session = button.getAttribute('data-bs-session')

    // Update the modal's content.
    var modalTitle = moviesModal.querySelector('.modal-title')
    var modalDescription = moviesModal.querySelector('.modal-text')
    var modalProducer = moviesModal.querySelector('.producer')
    var modalScenario = moviesModal.querySelector('.scenario')
    var modalActors = moviesModal.querySelector('.actors')
    var modalRelease = moviesModal.querySelector('.release')
    var modalType = moviesModal.querySelector('.type')
    var modalDuration = moviesModal.querySelector('.duration')
    var modalSession = moviesModal.querySelector('.modal-footer .text-muted')
    
    // Creation and update of the image to avoid W3C errors
    var imgParent = moviesModal.querySelector('.moviesModal-img-parent');
    if (imgParent.childElementCount === 0) {
      var newModalImg = imgParent.appendChild(document.createElement('img'));
      newModalImg.classList.add('img-modal-top');
      newModalImg.setAttribute('alt', imgAlt);
      newModalImg.setAttribute('src', imgSrc);
    } else {
      var modalImg = moviesModal.querySelector('.img-modal-top');
      modalImg.removeAttribute('alt');
      modalImg.removeAttribute('src');
      modalImg.setAttribute('alt', imgAlt);
      modalImg.setAttribute('src', imgSrc);
    }

    modalTitle.textContent = title
    modalDescription.textContent = description
    modalProducer.textContent = 'Réalisation : ' + producer
    modalScenario.textContent = 'Scénario : ' + scenario
    modalActors.textContent = 'Acteurs pricipaux : ' + actors
    modalRelease.textContent = 'Sortie : ' + release
    modalType.textContent = 'Genre : ' + type
    modalDuration.textContent = 'Durée : ' + duration
    modalSession.textContent = 'Les séances auront lieux ' + session
})

  // News Modal
  var newsModal = document.getElementById('newsModal')
  newsModal.addEventListener('show.bs.modal', function (event) {

    // Button that triggered the modal
    var button = event.relatedTarget

    // Extract info from data-bs-* attributes
    var title = button.getAttribute('data-bs-title')
    var imgSrc = button.getAttribute('data-bs-img')
    var imgAlt = button.getAttribute('data-bs-imgAlt')
    var description = button.getAttribute('data-bs-description')
    var publicationDate = button.getAttribute('data-bs-publicationDate')
    var publicationAuthor = button.getAttribute('data-bs-publicationAuthor')

    // Creation and update of the image to avoid W3C errors
    var imgParent = newsModal.querySelector('.newsModal-img-parent');
    if (imgParent.childElementCount === 0) {
      var newModalImg = imgParent.appendChild(document.createElement('img'));
      newModalImg.classList.add('img-modal-top');
      newModalImg.setAttribute('alt', imgAlt);
      newModalImg.setAttribute('src', imgSrc);
    } else {
      var modalImg = newsModal.querySelector('.img-modal-top');
      modalImg.removeAttribute('alt');
      modalImg.removeAttribute('src');
      modalImg.setAttribute('alt', imgAlt);
      modalImg.setAttribute('src', imgSrc);
    }

    // Update the modal's content.
    var modalTitle = newsModal.querySelector('.modal-title')
    var modalDescription = newsModal.querySelector('.modal-text')
    var modalPublication = newsModal.querySelector('.modal-footer')
    
    modalTitle.textContent = title
    modalDescription.textContent = description
    modalPublication.textContent = 'Publié le ' + publicationDate + ' par ' + publicationAuthor
})