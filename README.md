# pureblog
#### PHP flatfile self-hostable platform for simple markdown blogging based on writefreely design and principles.

Simple CMS for blogging with nothing in between. Just writing.
Flat-file system doesn't require any database and no dependencies.

### Install
1. Simply copy all content to root or subfolder of your web server / hosting.
2. Make sure that the directories has rights of 775 and files 664.
3. Open the folder in browser and log in with password "pencil" (change it in Settings afterwards)

### Use
Just write. No rules but one, every blog __post must begin with title__ (# heading).
You can now enable custom Pages from the _Extra_ section of the Settings page (visible from blog admin menu).

### Purpose
I wanted to have a simple environment for me to write my posts without any distractions from the UI, without multiple dependencies and that could run on a web hosting without a server.
I also want (for me and for people) to actually own the content. Another big important aspect for me personally is the ability to write from everywhere. Static-site-generators are great, but I need to be able to write on my friend's phone or at café. I took a design inpiration from the great project [writefreely](https://github.com/writeas/writefreely), they really came with the barebone solution of having all the important aspects of blog management, __but__ nothing else. I added and am adding some more features I believe are handy, yet still doesn't come in a way.

### Licence
This project is free software licenced with GPL. The markdown-to-html backend converter is MIT-licenced code for which the Licence at full can be found at its subdirectory.

### Upcoming
 - same-day posts sorted by time
 - beggining with the title will not be required in future
 - langauges support
 - drafts
 - securing admin changes from CSRF
 - blog-type switch between posts with perex or just a title
 - minor design customizations
 - dark mode
 
### Support the project
If you like this project, you can support me on Librepay here [![LP](https://liberapay.com/assets/widgets/donate.svg)](https://liberapay.com/arajnoha/donate). You can also make pull requests or get in touch with me on adam@rajnoha.com.
Note that I am intentionally not using javascript for almost anything, because I want the native browser behaviour to work and use few lines of JS when really necessary.
