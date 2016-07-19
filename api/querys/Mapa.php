select p.latitude, p.longitude, p.time from gcf.usuarios u
inner join gcf.users_devices ud
on ud.users_id = u.USU_IN_CODIGO
inner join gcf.positions p
on ud.devices_id = p.device_id
where u.USU_IN_CODIGO = 4 order by time desc limit 1