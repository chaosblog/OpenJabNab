#include <QHttp>
#include <QStringList>
#include <QUrl>
#include <QFile>
#include "log.h"
#include "soundmanager.h"
#include "settings.h"

bool SoundManager::createNewSound(QString text, QString voice, QString fileName)
{
	QStringList voiceList;
	// French voices
	voiceList << "claire" << "alice" << "bruno" << "julie";

	if(!voiceList.contains(voice))
		voice = "claire";

	QString HeaderData = "";
	QByteArray ContentData = "";

	ContentData += "php%5Fvar%5Fdec=undefined&php%5Fvar%5Fhtml=undefined&php%5Fvar%5Fstring=" + voice + "22k%5B%2Fvoix%5D" + QUrl::toPercentEncoding(text) + "&php%5Fvar%5Fnom=whatever%2Etxt&php%5Fverif=flash&onLoad=%5Btype%20Function%5D";

	HeaderData += "POST /Demo_Web/write.php HTTP/1.1\r\n";
	HeaderData += "Host:vaas3.acapela-group.com\r\n";
	HeaderData += "User-Agent: Mozilla/5.0 (X11; U; Linux i686; fr; rv:1.9.0.1) Gecko/2008072820 Firefox/3.0.1\r\n";
	HeaderData += "Referer: http://vaas3.acapela-group.com/Demo_Web/synthese_movieclip_small.swf\r\n";
	HeaderData += "Content-type: application/x-www-form-urlencoded\r\n";
	HeaderData += "Content-length: " + QString::number(ContentData.length()) + "\r\n";

	QHttp* http = new QHttp("vaas3.acapela-group.com");
	connect(http, SIGNAL(done(bool)), this, SLOT(downloadDone()));

	http->request(HeaderData, ContentData);
	loop.exec();
	QByteArray reponse = http->readAll();
	if(reponse.startsWith("&retour_php"))
	{
		QString acapelaFile = reponse.mid(12);
		http->get("/Demo_Web/Sorties/" + acapelaFile + ".mp3");
		loop.exec();
		QFile file(GlobalSettings::GetString("OpenJabNabServers/HttpPath") + fileName);
		if (!file.open(QIODevice::WriteOnly))
		{
			Log::Error("Cannot open config file for writing");
			return false;
		}
		QDataStream out(&file);
		out << http->readAll();
		return true;
	}
	Log::Error("Acapela demo did not return a sound file");
	return false;
}

void SoundManager::downloadDone()
{
	loop.exit();
}
