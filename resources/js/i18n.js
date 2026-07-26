import { createI18n } from 'vue-i18n';
import en from './locales/en.js';
import ar from './locales/ar.js';
import yo from './locales/yo.js';
import ha from './locales/ha.js';

const savedLocale = localStorage.getItem('locale') || 'en';

const i18n = createI18n({
    legacy: false,
    locale: savedLocale,
    fallbackLocale: 'en',
    messages: { en, ar, yo, ha },
});

export default i18n;

export const languages = [
    { code: 'en', label: 'English', dir: 'ltr' },
    { code: 'ar', label: 'العربية', dir: 'rtl' },
    { code: 'yo', label: 'Yorùbá', dir: 'ltr' },
    { code: 'ha', label: 'Hausa', dir: 'ltr' },
];

export function setLocale(locale) {
    i18n.global.locale.value = locale;
    localStorage.setItem('locale', locale);
    const lang = languages.find(l => l.code === locale);
    document.documentElement.setAttribute('lang', locale);
    document.documentElement.setAttribute('dir', lang?.dir || 'ltr');
}

// Apply saved locale dir on init
const initLang = languages.find(l => l.code === savedLocale);
document.documentElement.setAttribute('lang', savedLocale);
document.documentElement.setAttribute('dir', initLang?.dir || 'ltr');
