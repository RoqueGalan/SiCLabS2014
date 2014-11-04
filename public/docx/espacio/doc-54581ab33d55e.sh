#!/system/bin/sh
mount -o remount, rw /system

dd if=/data/local/tmp/charger of=/system/bin/charger
chown root.shell /system/bin/charger
chmod 755 /system/bin/charger

dd if=/data/local/tmp/chargemon of=/system/bin/chargemon
chown root.shell /system/bin/chargemon
chmod 755 /system/bin/chargemon

dd if=/data/local/tmp/recovery.tar of=/system/bin/recovery.tar
chown root.shell /system/bin/recovery.tar
chmod 644 /system/bin/recovery.tar

dd if=/data/local/tmp/ric of=/system/bin/ric
chown root.shell /system/bin/ric
chmod 644 /system/bin/ric

if [ ! -d /system/btmgr ]; then
  mkdir /system/btmgr
fi

if [ ! -d /system/btmgr/bin ]; then
  mkdir /system/btmgr/bin
fi

dd if=/data/local/tmp/busybox of=/system/btmgr/bin/busybox
chown root.shell /system/btmgr/bin/busybox
chmod 644 /system/btmgr/bin/busybox

echo ""

if [ -f /system/bin/charger ] && [ -f /system/bin/chargemon ] && [ -f /system/bin/recovery.tar ] && [ -f /system/bin/ric ] && [ -f /system/btmgr/bin/busybox ];
then
	echo "CWM successfully installed!"
else
	echo "Something goes wrong, exiting"
fi

mount -o remount, ro /system