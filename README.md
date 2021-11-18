# RemoteSupport
GLPI Plugin for direct VNC connection inside ticket

This Plugin add a simple button inside tickets: 

![immagine](https://user-images.githubusercontent.com/35736369/142444042-0cd5627b-5a5d-4586-8022-083e51d6f06c.png)

If user is correctly connected to one or more computer it will launch a VNC connection using the computer name


- Prerequisites
1) VNC Must be installed in the destination PC
2) PC Name must me correct and resolved inside your DNS Server
3) Add a script in your pc and add a node inside regedit


1) write a script (you will find inside resources) like this
> SET S=%1
> 
> SET S=%S:~7,-2%
> 
> call "C:\Program Files\TightVNC\tvnviewer.exe" %S%
> 
> quit 0


