<footer class="footer">
  <div class="container footer-grid">
    <div class="footer-brand">
      <div class="logo">FitGuide</div>
      <p class="tagline">{{ __('footer.tagline') }}</p>
    </div>

    <nav class="footer-links">
      <h4>{{ __('footer.explore') }}</h4>
      <a href="/exercises">{{ __('footer.exercises') }}</a>
      <a href="/store">{{ __('footer.store') }}</a>
      <a href="/advice">{{ __('footer.advice') }}</a>
    </nav>

    <nav class="footer-links">
      <h4>{{ __('footer.company') }}</h4>
      <a href="#">{{ __('footer.about_us') }}</a>
      <a href="#">{{ __('footer.contact') }}</a>
      <a href="#">{{ __('footer.careers') }}</a>
    </nav>

    <div class="footer-newsletter">
      <h4>{{ __('footer.get_updates') }}</h4>
      <p>{{ __('footer.newsletter_text') }}</p>
      <form class="nl-form" method="POST" action="{{ route('newsletter.subscribe') }}">
        @csrf
        <input type="hidden" name="language" value="{{ app()->getLocale() }}">
        <input type="email" name="email" placeholder="{{ __('footer.email_placeholder') }}" required>
        <button type="submit" class="nl-btn">{{ __('footer.subscribe') }}</button>
      </form>
      <div class="footer-socials">
        <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
        <a href="#" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
        <a href="#" aria-label="Twitter"><i class="fab fa-x-twitter"></i></a>
        <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
      </div>
    </div>
  </div>

  <div class="container footer-bottom">
    <span>© {{ date('Y') }} FitGuide</span>
    <div class="legal">
      <a href="#">{{ __('footer.privacy') }}</a><span>•</span>
      <a href="#">{{ __('footer.terms') }}</a><span>•</span>
      <a href="#">{{ __('footer.cookies') }}</a>
    </div>
  </div>
</footer>