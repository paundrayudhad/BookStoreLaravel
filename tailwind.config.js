import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import aspectRatio from '@tailwindcss/aspect-ratio';
import tailwindAnimate from 'tailwindcss-animate';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: ["class"],
    content: ["./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php", "./storage/framework/views/*.php", "./resources/views/**/*.blade.php", "./resources/js/**/*.js", "*.{js,ts,jsx,tsx,mdx}"],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Custom colors untuk bookstore
                primary: {
                    DEFAULT: '#3b82f6',
                    50: '#eff6ff',
                    100: '#dbeafe',
                    200: '#bfdbfe',
                    300: '#93c5fd',
                    400: '#60a5fa',
                    500: '#3b82f6',
                    600: '#2563eb',
                    700: '#1d4ed8',
                    800: '#1e40af',
                    900: '#1e3a8a',
                    950: '#172554',
                },
                secondary: {
                    DEFAULT: '#64748b',
                    50: '#f8fafc',
                    100: '#f1f5f9',
                    200: '#e2e8f0',
                    300: '#cbd5e1',
                    400: '#94a3b8',
                    500: '#64748b',
                    600: '#475569',
                    700: '#334155',
                    800: '#1e293b',
                    900: '#0f172a',
                    950: '#020617',
                },
                destructive: {
                    DEFAULT: '#ef4444',
                    50: '#fef2f2',
                    100: '#fee2e2',
                    200: '#fecaca',
                    300: '#fca5a5',
                    400: '#f87171',
                    500: '#ef4444',
                    600: '#dc2626',
                    700: '#b91c1c',
                    800: '#991b1b',
                    900: '#7f1d1d',
                    950: '#450a0a',
                },
                muted: {
                    DEFAULT: '#f3f4f6',
                },
                accent: {
                    DEFAULT: '#22c55e',
                },
                popover: {
                    DEFAULT: '#ffffff',
                },
                card: {
                    DEFAULT: '#ffffff',
                },
                success: {
                    50: '#f0fdf4',
                    100: '#dcfce7',
                    200: '#bbf7d0',
                    300: '#86efac',
                    400: '#4ade80',
                    500: '#22c55e',
                    600: '#16a34a',
                    700: '#15803d',
                    800: '#166534',
                    900: '#14532d',
                    950: '#052e16',
                },
                warning: {
                    50: '#fffbeb',
                    100: '#fef3c7',
                    200: '#fde68a',
                    300: '#fcd34d',
                    400: '#fbbf24',
                    500: '#f59e0b',
                    600: '#d97706',
                    700: '#b45309',
                    800: '#92400e',
                    900: '#78350f',
                    950: '#451a03',
                },
                danger: {
                    50: '#fef2f2',
                    100: '#fee2e2',
                    200: '#fecaca',
                    300: '#fca5a5',
                    400: '#f87171',
                    500: '#ef4444',
                    600: '#dc2626',
                    700: '#b91c1c',
                    800: '#991b1b',
                    900: '#7f1d1d',
                    950: '#450a0a',
                },
                border: "hsl(var(--border))",
                input: "hsl(var(--input))",
                ring: "hsl(var(--ring))",
                background: "hsl(var(--background))",
                foreground: "hsl(var(--foreground))",
            },
            spacing: {
                '18': '4.5rem',
                '88': '22rem',
                '128': '32rem',
            },
            maxWidth: {
                '8xl': '88rem',
                '9xl': '96rem',
            },
            minHeight: {
                '16': '4rem',
                '20': '5rem',
                '24': '6rem',
            },
            animation: {
                'fade-in': 'fadeIn 0.5s ease-in-out',
                'slide-up': 'slideUp 0.3s ease-out',
                'slide-down': 'slideDown 0.3s ease-out',
                'bounce-slow': 'bounce 2s infinite',
                'pulse-slow': 'pulse 3s infinite',
            },
            keyframes: {
                fadeIn: {
                    '0%': { opacity: '0' },
                    '100%': { opacity: '1' },
                },
                slideUp: {
                    '0%': { transform: 'translateY(10px)', opacity: '0' },
                    '100%': { transform: 'translateY(0)', opacity: '1' },
                },
                slideDown: {
                    '0%': { transform: 'translateY(-10px)', opacity: '0' },
                    '100%': { transform: 'translateY(0)', opacity: '1' },
                },
            },
            backdropBlur: {
                xs: '2px',
            },
            boxShadow: {
                'soft': '0 2px 15px -3px rgba(0, 0, 0, 0.07), 0 10px 20px -2px rgba(0, 0, 0, 0.04)',
                'medium': '0 4px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04)',
                'strong': '0 10px 40px -10px rgba(0, 0, 0, 0.15), 0 4px 25px -5px rgba(0, 0, 0, 0.1)',
                'glow': '0 0 20px rgba(59, 130, 246, 0.15)',
            },
            borderRadius: {
                '4xl': '2rem',
                lg: "var(--radius)",
                md: "calc(var(--radius) - 2px)",
                sm: "calc(var(--radius) - 4px)",
            },
            zIndex: {
                '60': '60',
                '70': '70',
                '80': '80',
                '90': '90',
                '100': '100',
            },
            screens: {
                'xs': '475px',
            },
        },
    },

    plugins: [
        forms({
            strategy: 'class', // Menggunakan class strategy untuk kontrol yang lebih baik
        }),
        aspectRatio,
        tailwindAnimate,
        
        // Plugin untuk line-clamp (truncate text)
        function({ addUtilities }) {
            const newUtilities = {
                '.line-clamp-1': {
                    overflow: 'hidden',
                    display: '-webkit-box',
                    '-webkit-box-orient': 'vertical',
                    '-webkit-line-clamp': '1',
                },
                '.line-clamp-2': {
                    overflow: 'hidden',
                    display: '-webkit-box',
                    '-webkit-box-orient': 'vertical',
                    '-webkit-line-clamp': '2',
                },
                '.line-clamp-3': {
                    overflow: 'hidden',
                    display: '-webkit-box',
                    '-webkit-box-orient': 'vertical',
                    '-webkit-line-clamp': '3',
                },
                '.line-clamp-4': {
                    overflow: 'hidden',
                    display: '-webkit-box',
                    '-webkit-box-orient': 'vertical',
                    '-webkit-line-clamp': '4',
                },
            }
            addUtilities(newUtilities, ['responsive'])
        },
        
        // Plugin untuk scrollbar styling
        function({ addUtilities }) {
            const scrollbarUtilities = {
                '.scrollbar-thin': {
                    'scrollbar-width': 'thin',
                },
                '.scrollbar-none': {
                    'scrollbar-width': 'none',
                    '-ms-overflow-style': 'none',
                    '&::-webkit-scrollbar': {
                        display: 'none',
                    },
                },
                '.scrollbar-track-gray-100': {
                    '&::-webkit-scrollbar-track': {
                        'background-color': '#f3f4f6',
                    },
                },
                '.scrollbar-thumb-gray-300': {
                    '&::-webkit-scrollbar-thumb': {
                        'background-color': '#d1d5db',
                        'border-radius': '0.375rem',
                    },
                },
                '.scrollbar-thumb-hover-gray-400': {
                    '&::-webkit-scrollbar-thumb:hover': {
                        'background-color': '#9ca3af',
                    },
                },
            }
            addUtilities(scrollbarUtilities)
        },
        
        // Plugin untuk glass morphism effect
        function({ addUtilities }) {
            const glassUtilities = {
                '.glass': {
                    'background': 'rgba(255, 255, 255, 0.25)',
                    'backdrop-filter': 'blur(10px)',
                    'border': '1px solid rgba(255, 255, 255, 0.18)',
                },
                '.glass-dark': {
                    'background': 'rgba(0, 0, 0, 0.25)',
                    'backdrop-filter': 'blur(10px)',
                    'border': '1px solid rgba(255, 255, 255, 0.18)',
                },
            }
            addUtilities(glassUtilities)
        },
    ],
};