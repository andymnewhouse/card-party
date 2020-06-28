---
title: Home
template: marketing/home
view_model: App\ViewModels\AngledHeroCards
sections:
  -
    bard:
      -
        type: paragraph
        content:
          -
            type: text
            marks:
              -
                type: italic
            text: INTRODUCING
      -
        type: set
        attrs:
          values:
            type: image
            image: logo-fire-opal.svg
            width: w-64
            center: false
            frame: false
      -
        type: paragraph
        content:
          -
            type: text
            text: 'Play Progressive Rummy with your friends and family, no matter where they are in the world!'
      -
        type: set
        attrs:
          values:
            type: buttons
            buttons:
              -
                text: 'Create an Account'
                link: /register
                new_tab: false
                color: btn-red-primary
                size: btn-xl
              -
                text: Login
                link: /login
                new_tab: false
                color: btn-blue-gray-secondary
                size: btn-xl
      -
        type: paragraph
    type: angled_hero
    enabled: true
  -
    uuid: 14ae6619-612c-4c47-ac5e-b7c0a79c4fd3
    header: 'Sign up for our newsletter'
    paragraph: 'Stay up to date on progress and be the first to know when we launch!'
    type: newsletter
    enabled: true
  -
    header: 'From the blog'
    paragraph: 'News, tips, and other stuff from Card Party.'
    type: blog
    enabled: true
updated_by: 1
updated_at: 1593376119
id: home
---
