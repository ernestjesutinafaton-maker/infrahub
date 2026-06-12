<!DOCTYPE html>
<html>
<body style="font-family: Arial; background: #f5f5f5; padding: 20px;">
    <div style="background: red; color: white; padding: 20px; border-radius: 8px;">
        <h1>ALERTE URGENCE - InfraHub</h1>
        <p><strong>Titre :</strong> {{ $ticket->titre }}</p>
        <p><strong>Description :</strong> {{ $ticket->description }}</p>
        <p><strong>Signale par :</strong> {{ $ticket->user->name }}</p>
        <p><strong>Date :</strong> {{ $ticket->created_at->format('d/m/Y H:i') }}</p>
        <p style="font-size: 18px; font-weight: bold;">
            Intervention requise immediatement !
        </p>
    </div>
</body>
</html>